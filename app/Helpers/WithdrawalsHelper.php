<?php 

namespace App\Helpers;
use App\User;
use Auth;
use App\Deposit;
use App\Roirecord;
use App\Account;
use App\Withdrawal;
use App\Transaction;

class WithdrawalsHelper{

	public static function monthlyRoi($uid)
	{
		$depositId = Deposit::where('user_id', $uid)->first()->id;

		return Roirecord::where('deposit_id', $depositId)->first()->amount;		
		
	}

	public static function getUplineId($uid)
	{
		$upId = User::where('id', $uid)->first()->upline_id;

		return User::where('id', $upId)->first()->username;		
	}

	public static function availableRoi($uid)
	{
		
		return Account::where('id', $uid)->first()->roi_balance;
	}

	public static function lastTerm($uid)
	{
		
		$depositId = Deposit::where('user_id', $uid)->first()->id;

		// return Roirecord::where('deposit_id', $depositId)->where('status', 1)->get()->last()->terms;	

	}

	public static function depositDate($uid)
	{
		
		$depositDate = Deposit::where('user_id', $uid)->first()->rcvd_date;

		return date('Y-m-d', strtotime($depositDate));

	}

	public static function depositAmount($uid)
	{
		
		return Deposit::where('user_id', $uid)->first()->amount;
		

	}


	public static function withdarawnRoiTill($uid)
	{
		
		// $depositId = Deposit::where('user_id', $uid)->first()->id;

		$getAmount = Withdrawal::where('user_id', $uid)->where('amount_type', 2)->where('status', 1)->get();	
		return $getAmount->sum('amount');

	}


	public static function withdarawnWbTill($uid)
	{
		
		// $depositId = Deposit::where('user_id', $uid)->first()->id;

		$getAmount = Withdrawal::where('user_id', $uid)->where('amount_type', 1)->where('status', 1)->get();	
		return $getAmount->sum('amount');

	}


	public static function drcTotal($uid)
	{
		
		return $drcIncome = Transaction::where('user_id', $uid)
 	                               ->where('tnx_id', 'like', 'drc%')
 	                               ->sum('amount');  
	}


	public static function srcTotal($uid)
	{
		
		
 	    $srcIncome = Transaction::where('user_id', $uid)
 	                               ->where('tnx_id', 'like', 'src%')
 	                               ->sum('amount');

	}

	public static function wtwIncome($uid)
	{
		
		
 	    return Transaction::where('user_id', $uid)
 	                               ->where('tnx_id', 'like', 'w2w%')
 	                               ->sum('amount');

	}

	public static function rtwIncome($uid)
	{
		
		
 	    return Transaction::where('user_id', $uid)
 	                               ->where('tnx_id', 'like', 'r2w%')
 	                               ->sum('amount');

	}

	public static function walletBalance($uid)
	{
		
		
 	    return Account::where('user_id', $uid)->first()->balance; 	                               

	}



}
