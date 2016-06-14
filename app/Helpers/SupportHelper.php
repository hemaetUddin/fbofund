<?php 

namespace App\Helpers;
use Auth;
use App\Support;

class SupportHelper{


	public static function supports($id)
	{
		$supports = Support::where('user_id', Auth::id())
                                  ->where('status',1)->get();
        return $supports;                          
	}
}

					