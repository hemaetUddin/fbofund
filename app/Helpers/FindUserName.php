<?php 

namespace App\Helpers;
use App\User;
use Auth;
use App\Deposit;
class FindUserName{

	public static function userName($uid)
	{

		if($uid==0)
		{
			return "---";
		}
		else{
			return User::where('id', $uid)->first()->username;	
		}
		
	}

	public static function getAccount($uid)
	{
		return Deposit::where('user_id', $uid)->first()->pmnt_account;

	}
}
