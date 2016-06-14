<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Auth\Guard;
use Carbon\Carbon;
use App\Http\Requests\RemarkRequest;

use App\User;
use App\Flashpoint;
use App\Carry;
use DB;
use App\Roirecord;
use App\Deposit;
use App\Account;
use App\Transaction;
use App\Withdrawal;
use App\Support;



use Auth;

class AdminController extends Controller
{
	public function index(){

		// $newMoods = Mood::where('created_at', '>=', Carbon::now()->subDay())->get();
		// return User::sinceDaysAgo(2)->get();
		$today = date('Y-m-d', strtotime(Carbon::now()->today()));
		
		$totalRegUser= User::where('signup_date', 'LIKE',  $today.'%')->get()->count('id');

		$totalDeposit = Deposit::where('rcvd_date', 'LIKE', $today.'%')->get()->sum('amount');
		$totalWithdRequest = Withdrawal::where('request_date', 'LIKE', $today.'%')->get()->sum('amount');
		
		$supportTickets = Support::where('status',0)->get();


		$dasboardDetails = ['totUser' => $totalRegUser, 'totDeposit' => $totalDeposit, 'totWithdReq' => $totalWithdRequest ];



		
		return view('admin.index', compact('dasboardDetails', 'supportTickets'));
	}





   
   public function blank(){
   		return view('admin.blank');
   }

	public function getDeposit(){
		return "Admin Make Deposit Page";
	}


	// Withdrawal Process


	public function getWithdrawal(){

		$withdrawalTable = Withdrawal::where('status',0)->get();

		return view('admin.withdrawal.withdrawals', compact('withdrawalTable'));
	}

	public function getWithdrawalCancel(RemarkRequest $request){

		// $tnx_id = 'wcr_'.rand(1,99999999);

		Withdrawal::where('id', $request->id)->update(['status'=> 2, 'response_date' => Carbon::now(), 'remark'=>$request->remarks]);

		$getAmount = Withdrawal::where('id', $request->id)->first();

		$refundAmount = $getAmount->amount + $getAmount->wdrl_chrg;

		if($getAmount->amount_type==1){

			Account::where('user_id', $getAmount->user_id)->increment('balance' , $refundAmount);

		}
		else
		{

			Account::where('user_id', $getAmount->user_id)->increment('roi_balance' ,$refundAmount);

		}		

		
		//27.02.16 This transaction shoud'nt add to transaction table because this transaction before added when withdraw request was made.

		/*Transaction::insert(
					        [
					        'tnx_id' => $tnx_id,
					        'amount' => $refundAmount,
					        'sign'   => '+',
					        'purpose' => 15,
					        'date'  => Carbon::now(),   
					        'user_id' => $request->id,
					        // 'related_id' =>Auth::user()->id
					        ]);*/

		return redirect()->back()->with('smessage','Successfully withdrawal request canceled.');

	}


	public function getWithdrawalCheck($id)
	{



		$withdrawalTable = Withdrawal::where('id', $id)->first();
		$userBalance = Account::where('user_id', $withdrawalTable->user_id)->first();


		if( $withdrawalTable->amount_type == 2 )  // check roi balance
		{
			

			$roiToRoiReceived = Transaction::where('tnx_id', 'LIKE', 'r2r%')
											->where('sign', '+')
											->where('user_id', $withdrawalTable->user_id)
											->get()->sum('amount');

			$checkDeposit = Deposit::where('user_id', $withdrawalTable->user_id)->first();

			$r2rSend = Transaction::where('tnx_id', 'LIKE', 'r2r%')
											->where('sign', '-')
											->where('user_id', $withdrawalTable->user_id)
											->get()->sum('amount');

			$r2wTransfer = 	Transaction::where('tnx_id', 'LIKE', 'r2w%')
											->where('sign', '-')
											->where('user_id', $withdrawalTable->user_id)
											->get()->sum('amount');

			$acceptedRoi = Withdrawal::where('user_id', $withdrawalTable->user_id)
								  ->where('amount_type',2)
								  ->where('status',1)->sum(DB::raw('amount + wdrl_chrg'));

			$allWithdrawRequestedAmount = Withdrawal::where('user_id', $withdrawalTable->user_id)
								  ->where('amount_type',2)
								  ->where('status',0)->sum(DB::raw('amount + wdrl_chrg'));

			number_format($acceptedRoi,2);								  



			$totalRoiDeducted = $r2rSend + $r2wTransfer + $acceptedRoi;

			if($checkDeposit != null) //if deposited
			{

				$depositId = $checkDeposit->id;

				$schMonthlyRoi = Roirecord::where('deposit_id', $depositId)
											->where('status',1)->get()
											->sum('amount');

				$totalReceivedRoi = $roiToRoiReceived + $schMonthlyRoi;	


				//accepted roi amount and transaction cross check start
					$acceptedTnxIds = Withdrawal::where('user_id',$withdrawalTable->user_id)
								->where('status',1)->get();	

					
					$transactedAmount = Transaction::where('purpose', 17)->get()->sum('amount');

					// return number_format($transactedAmount,2) . "---" . number_format($acceptedRoi,2);

					// return $diffAmount = $transactedAmount - $acceptedRoi;

					if( $acceptedRoi != $transactedAmount)
					{
						return redirect()->back()->with('message', 'Total ROI withdrawn amount and requested ROI withdrawal amount mismatch. Total transacted amount '.$transactedAmount .' and Total Accepted ROI '  . $acceptedRoi );	
					}
					

				//accepted roi amount and transaction cross check end

				
				if ( $totalRoiDeducted > $totalReceivedRoi ){

					return "Total ROI in amount and total ROI out amount mismatch";
				}

				
				
				//check rest roi amount and original roi amount

				$restRoiAmount =  $totalReceivedRoi - ($totalRoiDeducted + $allWithdrawRequestedAmount);
				$currentRoiBalance = $userBalance->roi_balance;

				if($restRoiAmount != $currentRoiBalance){

					if($restRoiAmount > $currentRoiBalance)
					{
						$result = $restRoiAmount - $currentRoiBalance;
						return redirect()->back()->with('message', 'Original ROI balance is USD'. $result .' grater than current account balance');
					}else{

						$result = $currentRoiBalance - $restRoiAmount;
						return redirect()->back()->with('message', 'Current account balance is USD'. $result .' grater than original ROI balance.');
					}
					
				}

				//check rest roi amount and original roi balance end


				$realAvailableRoiBalance = $totalReceivedRoi - $totalRoiDeducted;

				$requestedAmount = $withdrawalTable->amount;

				if( $requestedAmount > $realAvailableRoiBalance )
				{
					return redirect()->back()->with('message', 'The withdrawal amount is invalid.');	
				}
				else
				{
					return redirect()->back()->with('smessage','The withdrawal amount is valid.');
				}

			} 
			else //if not deposited 
			{
				if($totalRoiDeducted > $roiToRoiReceived)
				{
					return "Total ROI in amount and total ROI out amount mismatch";
				}
				
				
				// return $allWithdrawRequestedAmount;
				// return $roiToRoiReceived;

				//check rest roi amount and original roi balance start

				return $restRoiAmount =  $roiToRoiReceived - ($totalRoiDeducted + $allWithdrawRequestedAmount);
				$currentRoiBalance = $userBalance->roi_balance;

				if($restRoiAmount != $currentRoiBalance){

					if($restRoiAmount > $currentRoiBalance)
					{
						$result = $restRoiAmount - $currentRoiBalance;
						return redirect()->back()->with('message', 'Original ROI balance is USD'. $result .' grater than current roi account balance');
					}else{

						$result = $currentRoiBalance - $restRoiAmount;
						return redirect()->back()->with('message', 'Current roi account balance is USD'. $result .' grater than original ROI balance.');
					}
					
				}	

				//check rest roi amount and original roi balance end		


				$realAvailableRoiBalance = $roiToRoiReceived - $totalRoiDeducted;

				$requestedAmount = $withdrawalTable->amount;

				if( $requestedAmount > $realAvailableRoiBalance)
				{
					return redirect()->back()->with('message', 'The withdrawal amount is invalid');
				}

				
				return redirect()->back()->with('smessage','The withdrawal amount is valid.');

			}

		}
		else // check for wallet balance
		{

			// return "This is wallet balance";

			//get received wallet balance

			$w2wReceived = Transaction::where('tnx_id', 'LIKE', 'w2w%')
						 ->where('user_id', $withdrawalTable->user_id)
						 ->where('sign', '+')->get()->sum('amount');

			$r2wReceived = Transaction::where('tnx_id', 'LIKE', 'r2w%')
						  ->where('user_id', $withdrawalTable->user_id)
						  ->where('sign', '-')->sum(DB::raw('amount'));

			$drcReceived = Transaction::where('tnx_id', 'LIKE', 'drc%')
						  ->where('user_id', $withdrawalTable->user_id)
						  ->where('sign', '+')->get()->sum('amount');

			$srcReceived = Transaction::where('tnx_id', 'LIKE', 'src%')
						  ->where('user_id', $withdrawalTable->user_id)
						  ->where('sign', '+')->get()->sum('amount');

			$totalWalletReceived = $w2wReceived + $r2wReceived + $drcReceived + $srcReceived;				  

			

			//get deducted wallet balance

			$accountActivation = Transaction::where('user_id', $withdrawalTable->user_id)
								 ->where('sign', '-')
								 ->where('tnx_id', 'LIKE', 'aa%')
								 ->get()->sum('amount');

			$w2wTransfer = Transaction::where('user_id', $withdrawalTable->user_id)
								 ->where('sign', '-')
								 ->where('tnx_id', 'LIKE', 'w2w%')
								 ->get()->sum('amount');					 


			$newDeposit = Transaction::where('user_id', $withdrawalTable->user_id)
							->where('tnx_id', 'LIKE','nd%')
							->get()->sum('amount');	


			$allWithdrawRequestedAmount = Withdrawal::where('user_id', $withdrawalTable->user_id)
								  ->where('amount_type',1)
								  ->where('status',0)->sum(DB::raw('amount + wdrl_chrg'));				

			$totalWalletDeduct = $accountActivation + $w2wTransfer + $newDeposit + $allWithdrawRequestedAmount;								

			$realWalletAmount = $totalWalletReceived - $totalWalletDeduct;

			$currentWalletBalance = $userBalance->balance; 

			if($totalWalletDeduct > $totalWalletReceived)
				{
					return redirect('/admin/withdrawal')->with('message', 'Total wallet in amount and total wallet out amount mismatch');
				}

			//check rest wallet amount and original wallet balance start
			
			if( $realWalletAmount != $currentWalletBalance)
			{
				if($realWalletAmount > $currentWalletBalance){

					$result = $realWalletAmount - $currentWalletBalance;

					return redirect('/admin/withdrawal')->with('message','Original wallet balance is USD'. $result .' grater than current wallet balance.');

				}else
				{
					$result = $currentWalletBalance - $realWalletAmount;

					return redirect('/admin/withdrawal')->with('message','Current wallet account balance is USD'. $result .' grater than original wallet balance.');
				}
				
			}

			//check rest wallet amount and original wallet balance end

			$realAvailableWalletBalance = $totalWalletReceived - $totalWalletDeduct;

			$requestedAmount = $withdrawalTable->amount;

			if( $requestedAmount > $realAvailableWalletBalance)
			{
				return redirect()->back()->with('message', 'The withdrawal wallet amount is invalid');
			}

			
			return redirect()->back()->with('smessage','The withdrawal wallet amount is valid.');
			// return redirect()->back()->with('message','admin.flash.alert');

			
		}


				

	}



// Withdrawal Process end




	public function getTransfer(){
		return "Admin Transfer Page";
	}

	public function stepReferralGenerate(){
		return view('admin.stepreferral');
	}

	public function getGenerate(Flashpoint $flashpoint){
		return $flashpoint->generateReferralPoints();
	}





	public function getRoiProcess()
	{
		return view('admin.roi.roiprocess');
	}

	





	public function getRoiGenerate(Roirecord $roirecord)
	{

		
		$checkRoiStatus = $roirecord->where(DB::raw('date(pmnt_date)'), Carbon::today())->first(); // This query is for checking roi status is paid or unpaid

		if($checkRoiStatus == null){
			return redirect()->back()->with('message', 'No roi found for today');
		}
		else if($checkRoiStatus->status == 1){
			return redirect()->back()->with('message', 'ROI already generated for today');
		}



		$roiRecords = $roirecord->where(DB::raw('date(pmnt_date)'), Carbon::today())->get();



		$depIdAndAmount = [];

		foreach ($roiRecords as $roirec) {

			
			array_push($depIdAndAmount , ['id' => $roirec->deposit_id, 'amount' => $roirec->amount] );
		}

		
		$total = 0;

		
		foreach( $depIdAndAmount as $da){
						$total += $da['amount']; 


						$depositHistory = Deposit::where('id', $da['id'])->first();

						Account::where('user_id', $depositHistory->user_id)->increment('roi_balance' , $da['amount']);
						$roirecord->where(DB::raw('date(pmnt_date)'), Carbon::today())->update(['status'=>1]);

						Transaction::insert(
			    						[
			    						'tnx_id' => 'rp_'.rand(1,99999999),
			    						'amount' => $da['amount'], 
			    						'sign'   => '+',
			    						'purpose' => 14,
			                            // 'proce_fee' => $transferComission,
			    						'date'  => Carbon::now(),   
			    						'user_id' => $depositHistory->user_id,
			    						]);
		}

		$totUser = count($depIdAndAmount);
		return redirect()->back()
							 ->with('message0', 'ROI payment generated successfully')
							 ->with('message1', "Total Amount USD: ". $total)
							 ->with('message2', "ROI payment generated for ". $totUser." users");

	}




    

    
}
