<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\Account;
use App\Transaction;
use Auth;
use DB;

class Deposit extends Model
{
    

protected $table = 'deposits';





    /**
    * @ prams $payAmount, $payeeAccount, $payStatus
    * depositWithPerfectMoney This function is for PERFECT MONEY return value
    * All the process of deposit with wallet balance 
    *
    * @return mixed
    */

    public function depositWithPerfectMoney($payAmount, $payeeAccount, $payStatus)
    {
    	if($payStatus == 0)
    	{
    		return redirect()->back()->with('message','Deposit Failed');
    	} /*check payment status */

    	if($payAmount)
	    	{
	    		// return "got payment";
	    		//One user can deposit only once
	    		
	    		Deposit::insert([
						'user_id' => Auth::user()->id,
						'amount' => $payAmount,
						'pmnt_method'  => 'pm',
						'pmnt_account' => $payeeAccount,
						'rcvd_date' => Carbon::now()
						]);

	    		// return redirect()->back()->with('message','Deposited Successfully');	

	    		Account::where('user_id', Auth::id())
	    				->increment('balance', $payAmount);

	    		// return redirect()->back()->with('message','Amount added to account table Successfully');
	    		Transaction::insert(
					[
					'tnx_id' => 'nd_'.rand(1,99999999),
					'amount' => $payAmount,
					'sign'   => '+',
					'purpose' => 11,
					'date'  => Carbon::now(),   
					'user_id' => Auth::user()->id,
					// 'related_id' =>22
					]);		
	    		// return redirect()->back()->with('message','Transaction inserted Successfully');

	    		$depositId = Deposit::where('user_id',Auth::user()->id)->get()->last(); //find deposit id for creating roi schedule
					// One User Can deposit for one time only. It should check before deposit
					
					$roiAmount = ($payAmount * 20)/100;
					
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
					$comissionAmount = (10*$payAmount)/100;
					Account::where('user_id', $referrarId)->increment('balance', $comissionAmount);

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

					$this->carry(Auth::user()->id, Auth::user()->upline_id, $payAmount);

					// $this->updateMatchingQualify();

					return redirect()->back()->with('smessage', "Successfully Deposited");


	    	}						
    	else
	    	{
				return redirect()->back()->with('message','Deposit Amount not found');
	    	} /*pay amount check if end*/

    } //end depositWithPerfectMoney function












    

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

    	

    	




}
