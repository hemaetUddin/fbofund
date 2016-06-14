<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

use App\Http\Requests\WithdrawRequest;
use App\Http\Requests\DepositRequest;

use App\Account;
use App\Deposit;
use App\Transaction;
use App\Roirecord;
use App\Carry;
use App\User;
use App\Downline;
use App\Withdrawal;
use App\Paymentinfo;

use DB;


class AccountController extends Controller
{
	private $uplineId;
	private $positon =[];

	public function __construct()
	{
		
	}

    public function getDeposit()
    { 
    	
    	$checkDepositStatus = Deposit::where('user_id',Auth::user()->id)->get();

    	if(count($checkDepositStatus) > 0){
    		return redirect()->back()->with('depoMessage', 'You can not deposit twice in the same account');

    	};
    	return view('accounts.deposit');        
	}

	/**
	* Carry is recursive function
	* When user make deposit this function help to find user position where is.
	* Left or Right of upliner. And add points
	*
	* @return 
	*/
	
	public function carry($uid = null, $upid = null, $amount=null )
	{
		 
		// echo "<br/>".$upid . "<br/>";
		  
		$uplineUserId = User::where('id', $upid)->first()->upline_id;
		 
		$checkPosition = Downline::select('left_member_id', 'right_member_id')->where('user_id',$upid)->get();

		  // Carry::where('user_id', $upid)->update(['right_carry'=>250]);  	 


		 if($checkPosition){
		 	foreach ($checkPosition as $position) {
		 		 if($position->left_member_id == $uid && $position->right_member_id != $uid)
		 		 {
		 		 	$left_carry = Carry::where('user_id', $upid)->first()->left_carry;
		 		 	$newAmount = $left_carry + $amount;
		 		 	Carry::where('user_id', $upid)->update(['left_carry'=>$newAmount]);
		 		 }
		 		 else
		 		 {
		 		 	$right_carry = Carry::where('user_id', $upid)->first()->right_carry;
		 		 	$newAmount = $right_carry + $amount;
		 		 	Carry::where('user_id', $upid)->update(['right_carry'=>$newAmount]);
		 		 }
		 	}
		 }
		
		// recursivly find upper lavel users
		if(!empty($uplineUserId)){
			$this->carry($upid, $uplineUserId, $amount);
		}
	}
	// carry function end

	

	// Updating Matching Qualify start
	public function updateMatchingQualify()
	{
		$results = DB::table('carries')
                    ->join('transactions', function ($join) {
                        $join->on('carries.user_id', '=', 'transactions.user_id')
                             ->where('transactions.purpose', '=', 12);
                    })
                    ->get();

		            foreach ($results as $result) {

		                if($result->left_carry != 0 || $result->right_carry !=0 && $result->matching_qualify !=1){
		                	Carry::where('user_id', $result->user_id)->update(['matching_qualify'=>1]);
		                	
		                }
		                     }                                   
			           
			           
	}
	// Updating Matching Qualify end



	/**
	* makeDeposit
	* Data insert into deposit, transaction and roirecords table 
	* Upade carries table
	*
	* @return string
	*/

	public function makeDeposit(DepositRequest $request)
	{	

		if($request->pmethod == 'pm'){

			if($request->depost < 300 && $request->deposit > 10000)
			{
				return redirect()->back()->with('message','You can make deposit within USD300 to USD10000');
			}
			else
			{
				$data = [$request->pmethod, $request->deposit];
				return view('accounts.depositConfirm', compact('data'));
			}
		}
		
		
		// return "hello";
		if(Auth::user()->status == 0){ return redirect()->back();}

		//One user can deposit only once
		$checkDepositStatus = Deposit::where('user_id',Auth::user()->id)->get();

		if(count($checkDepositStatus) > 0){
			return redirect()->back()->with('message', 'You can not deposit twice in the same account');

		};

		$depositAmount = $request->deposit;
		if($depositAmount)
		{
			if($depositAmount < 300 && $depositAmount > 10000)
			{
				return redirect()->back()->with('message','You can make deposit within USD300 to USD10000');
			}

			if($request->pmethod == 'wb')
			
			{		

				// return $request->pmethod;
				$account = Account::where('user_id',Auth::user()->id)->first();
				if($account->balance<$depositAmount)
				{
					return redirect()->back()->with('message','You do not have sufficient balance');
				}else
				{
					
					
					Deposit::insert([
						'user_id' => Auth::user()->id,
						'amount' => $depositAmount,
						'pmnt_method'  => $request->pmethod,
						'pmnt_account' => 'Wallet Balance',
						'rcvd_date' => Carbon::now()
						]);

					// return "Successfully deposited";

					Transaction::insert(
					        [
					        'tnx_id' => 'nd_'.rand(1,99999999),
					        'amount' => $depositAmount,
					        'sign'   => '+',
					        'purpose' => 11,
					        // 'date'  => Carbon::now(),   
					        'user_id' => Auth::id(),
					        // 'related_id' =>Auth::user()->id
					        ]);

					$newDepBalance = $account->balance-$depositAmount; //Deduct deposited amount from account balance
					Account::where('user_id',Auth::user()->id)
							->update(['balance'=>$newDepBalance]);
					
					// return "Successfully updated";

					 


					// Create ROI (Return of Invest) Schedule

					$depositId = Deposit::where('user_id',Auth::user()->id)->get()->last(); /*find deposit id for creating roi schedule*/
					// One User Can deposit for one time only. It should check before deposit
					
					$roiAmount = ($depositAmount * 20)/100;
					
					for($i = 1; $i<=10; $i++){
						Roirecord::insert([
								'deposit_id' => $depositId->id, 
								'amount'	=> $roiAmount,
								'pmnt_date'=> Carbon::now()->addMonths($i),
								'terms'		=> $i,
								'status'	=> 0	
							]);
					} 
					// end for loop
					// Create ROI (Return of Income) Schedule End


					// Add Referrar's Comission 

					$referrarId = Auth::user()->referrar_id;
					$comissionAmount = (10*$depositAmount)/100;
					// $referrarBalance = Account::where('user_id',$referrarId)->first()->balance;
					// $newRefBalance = $referrarBalance+$comissionAmount;
					Account::where('user_id', $referrarId)->increment('balance', $comissionAmount);					
					// Add Referrar's Comission End


					//Insert Transaction Table Start

					Transaction::insert(
					[
					'tnx_id' => 'drc_'.rand(1,99999999),
					'amount' => $comissionAmount,
					'sign'   => '+',
					'purpose' => 12,
					'date'  => Carbon::now(),   
					'user_id' => $referrarId,
					'related_id' =>Auth::user()->id
					]);

					//Insert Transaction Table End
					
					$this->carry(Auth::user()->id, Auth::user()->upline_id, $depositAmount);

					$this->updateMatchingQualify();

					return redirect('/user')->with('smessage', "Successfully Deposited");

				}
			}
			
		}
		else
		{
			return redirect()->back()->with('message','Request could not processd');
		}
	}


	
	

	// Call all method from Deposit model for this function
	public function pmDeposit(Request $request, Deposit $deposit){
		return $request->all();
		$payerAccount = $request->PAYER_ACCOUNT;
		$payAmount = $request->PAYMENT_AMOUNT;
		$payStatus = $request->PAYMENT_BATCH_NUM;
		$time 	   = $request->TIMESTAMPGMT;

		return $deposit->depositWithPerfectMoney ( $payAmount, $payerAccount, $payStatus);

	}

	public function getWithdrawal(){
		/*$checkDepositStatus = Deposit::where('user_id',Auth::user()->id)->get();
		// return count($checkDepositStatus);
		
		if(count($checkDepositStatus) == 0){
			return redirect()->back()->with('message', 'You have not yet deposited.');

		};*/
		

		$takeBalance = Account::where('user_id', Auth::id())->first();
		$paymentMethodAndAccount = Deposit::where('user_id', Auth::id())->first();
		$balanceAndAccountInfo = [
									$takeBalance->balance,
									$takeBalance->roi_balance, 
									// $paymentMethodAndAccount->pmnt_method,
									// $paymentMethodAndAccount->pmnt_account
								];

		return view('accounts.withdrawal', compact('balanceAndAccountInfo'));
	}



	public function requestWithdraw(WithdrawRequest $request, Withdrawal $withdrawal)
	{
		
		 /**
		 * withdrawRequestProcess
		 * Prams:: $balanceType, $amount, $accoutn
		 * 
		 * @Return String
		 */
		 // return $request->all();
		return $withdrawal->withdrawRequestProcess($request->balance_type, $request->withdrawal_amount, $request->payment_account, $request->pincode);

	}















	// ajax functions

	// check deposit balance when make deposit with wallet balance
	public function checkDeposit($deposit){
		// echo $deposit;
		$userBalance = Account::where('user_id', Auth::id())->first()->balance;
		if($deposit > $userBalance)
		{
			echo json_encode(" You do not have sufficient balance ");
		}

	}

// Check balance through balance type and make compare with balance and request amount
	public function checkBalanceTypeAndCompare($balanceType)
	{
		// echo $balanceType;
		$accountInformation = Account::where('user_id', Auth::id())->first();
		$wbBalance  = ($accountInformation->balance * .05);
		$roiBalance = ($accountInformation->roi_balance* .05);

		$maxWbBalance = $accountInformation->balance - $wbBalance;
		$maxRoiBalance = $accountInformation->roi_balance - $roiBalance;

		if( $balanceType == 1 )
			{
				echo json_encode( $maxWbBalance );
			}
		else
			{
				echo json_encode( $maxRoiBalance );
			}	



	}


// Ajax 

	public function checkPinWithdrawalRequest($pin)
	{

		/*echo Auth::user()->pin;
		die();*/
		if( $pin != Auth::user()->pin){
			echo json_encode(" Invalid Secure PIN");
		}

	}


	public function checkAvailableBalance($withdralAmount)
	{
		$accountInformation = Account::where('user_id', Auth::id())->first();

		$wbBalance  = ($accountInformation->balance * .05);

		$roiBalance = ($accountInformation->roi_balance* .05);


		$maxWbBalance = $accountInformation->balance - $wbBalance;

		$maxRoiBalance = $accountInformation->roi_balance - $roiBalance;

		echo $maxWbBalance;



	}


	

}
