<?php 

namespace App\Helpers;
use App\User;
use Auth;
use App\Downline;
use App\Carry;

class ReferralTableValues{

	static $leftCount = 0;
	static $rightCount = 0;
	
	static $leftCount1 = 0;
    static $rightCount1 = 0;

	static $leftCount2 = 0;
    static $rightCount2 = 0;

    static $leftCount3 = 0;
    static $rightCount3 = 0;

    static $leftCount4 = 0;
    static $rightCount4 = 0;

    static $leftCount5 = 0;
    static $rightCount5 = 0;

    static $leftCount6 = 0;
    static $rightCount6 = 0;


	public static function referrarId($uid)
	{
		  
		$username = User::where('id', $uid)->first()->username;
		return $username;
		
	}

	public static function uplineId($uid)
	{
		  
		$username = User::where('id', $uid)->first()->username;
		return $username;
		
	}


	public static function leftMem($uid)
	{
		self::countLeftRightMem($uid);
		return self::$leftCount;
	}


	public static function rightMem($uid)
	{
		self::countLeftRightMem($uid);
		return self::$rightCount/2;
	}


	public static function leftMemOne($uid)
	{
		self::childOneLRMem($uid);
		return self::$leftCount1;
	}


	public static function rightMemOne($uid)
	{
		self::childOneLRMem($uid);
		return self::$rightCount1/2;
	}


	public static function leftMemTwo($uid)
	{
		self::childTwoLRMem($uid);
		return self::$leftCount2;
	}


	public static function rightMemTwo($uid)
	{
		self::childTwoLRMem($uid);
		return self::$rightCount2/2;
	}


	public static function leftMemThree($uid)
	{
		self::childThreeLRMem($uid);
		return self::$leftCount3;
	}


	public static function rightMemThree($uid)
	{
		self::childThreeLRMem($uid);
		return self::$rightCount3/2;
	}


	public static function leftMemFour($uid)
	{
		self::childFourLRMem($uid);
		return self::$leftCount4;
	}


	public static function rightMemFour($uid)
	{
		self::childFourLRMem($uid);
		return self::$rightCount4/2;
	}


	public static function leftMemFive($uid)
	{
		self::childFiveLRMem($uid);
		return self::$leftCount4;
	}


	public static function rightMemFive($uid)
	{
		self::childFiveLRMem($uid);
		return self::$rightCount4/2;
	}

	public static function leftMemSix($uid)
	{
		self::childSixLRMem($uid);
		return self::$leftCount4;
	}


	public static function rightMemSix($uid)
	{
		self::childSixLRMem($uid);
		return self::$rightCount4/2;
	}


// for top user start
	public static function countLeftRightMem($uid)
	{
			
			$leftAndRighUser = Downline::where('user_id', $uid)->first();   		
			

			if($leftAndRighUser->left_member_id && $leftAndRighUser->left_member_id != 0 )
			{
				
				self::$leftCount++;

			}

			if($leftAndRighUser->right_member_id && $leftAndRighUser->right_member_id != 0 )
			{
				
				self::$rightCount++;
								
			}

			if($leftAndRighUser->left_member_id != 0)
			{
				
				self::countLeftRightMem($leftAndRighUser->left_member_id);
			}
			if($leftAndRighUser->right_member_id != 0)
			{
				
				self::countLeftRightMem($leftAndRighUser->right_member_id);
			}
			
	}


// for child one


	public static function childOneLRMem($uid)
	{
			
			$leftAndRighUser = Downline::where('user_id', $uid)->first();   		
			

			if($leftAndRighUser->left_member_id && $leftAndRighUser->left_member_id != 0 )
			{
				
				

			}

			if($leftAndRighUser->right_member_id && $leftAndRighUser->right_member_id != 0 )
			{
				
				
			}

			if($leftAndRighUser->left_member_id != 0)
			{
				self::$leftCount1++;
				self::childOneLRMem($leftAndRighUser->left_member_id);
			}
			if($leftAndRighUser->right_member_id != 0)
			{
				self::$rightCount1++;
				self::childOneLRMem($leftAndRighUser->right_member_id);
			}
			
	}


// for child two


	public static function childTwoLRMem($uid)
	{
			
			$leftAndRighUser = Downline::where('user_id', $uid)->first();   		
			

			if($leftAndRighUser->left_member_id && $leftAndRighUser->left_member_id != 0 )
			{
				
				

			}

			if($leftAndRighUser->right_member_id && $leftAndRighUser->right_member_id != 0 )
			{
				
				
			}

			if($leftAndRighUser->left_member_id != 0)
			{
				self::$leftCount2++;
				self::childTwoLRMem($leftAndRighUser->left_member_id);
			}
			if($leftAndRighUser->right_member_id != 0)
			{
				self::$rightCount2++;
				self::childTwoLRMem($leftAndRighUser->right_member_id);
			}
			
	}


// for child two


	public static function childThreeLRMem($uid)
	{
			
			$leftAndRighUser = Downline::where('user_id', $uid)->first();   		
			

			if($leftAndRighUser->left_member_id && $leftAndRighUser->left_member_id != 0 )
			{
				
				

			}

			if($leftAndRighUser->right_member_id && $leftAndRighUser->right_member_id != 0 )
			{
				
				
			}

			if($leftAndRighUser->left_member_id != 0)
			{
				self::$leftCount3++;
				self::childThreeLRMem($leftAndRighUser->left_member_id);
			}
			if($leftAndRighUser->right_member_id != 0)
			{
				self::$rightCount3++;
				self::childThreeLRMem($leftAndRighUser->right_member_id);
			}
			
	}		

		



	
			public static function getCarryLeft($uid)
			{
				$leftCarry = Carry::where('user_id',$uid)->first()->left_carry;
				return $leftCarry;
			}

			public static function getCarryRight($uid)
			{
				$rightCarry = Carry::where('user_id',$uid)->first()->right_carry;
				return $rightCarry;
			}
		
	




















	/*public static function countMembersLeft($uid)
	{
		$downlineInfo = Downline::where('user_id', $uid)->first();
		
		if ( $downlineInfo->left_member_id == 0 ) {
		
		  return false;
		}
		
		else
		{
		  if ( $downlineInfo->left_member_id > 0){
		       
		       self::$leftCount++;
		       
		       self::countMembersLeft($downlineInfo->left_member_id);
		  }
		}

		if ( $downlineInfo->right_member_id == 0 ) {
		  
		  return false;
		}

		else

		{
		  
		  if ( $downlineInfo->right_member_id > 0 ) {
		 
		       self::$rightCount++;
		 
		       self::countMembersLeft($downlineInfo->right_member_id);
		 
		  }
		}
	}



	public static function countMembersRight($uid)
	{
		$downlineInfo = Downline::where('user_id', $uid)->first();
		
		if ( $downlineInfo->right_member_id == 0 ) {
		
		  return false;
		}
		
		else
		{
		  if ( $downlineInfo->right_member_id > 0){
		       
		       self::$righttCount++;
		       
		       self::countMembersRight($downlineInfo->right_member_id);
		  }
		}

		if ( $downlineInfo->left_member_id == 0 ) {
		  
		  return false;
		}

		else

		{
		  
		  if ( $downlineInfo->left_member_id > 0 ) {
		 
		       self::$leftCount++;
		 
		       self::countMembersRight($downlineInfo->left_member_id);
		 
		  }
		}
	}*/




}
