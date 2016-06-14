<?php 

namespace App\Helpers;
use App\User;
use Auth;
use App\Deposit;

class FindUserPayMethod{

	public static function findPayMethod($uid)
	{

		$depositTableValue = Deposit::where('user_id', $uid)->first();
		if($depositTableValue != null)
		{
			if($depositTableValue->pmnt_method == 'wb')
				{
					return 'wb';
				}
				else
				{
					return $depositTableValue->pmnt_account;
				}
		}
		else
		{
			return false;
		}
		
	}
}
