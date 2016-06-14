<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PasswordResetRequest;
use App\User;
use Mail;
use DB;
use Crypt;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
 

 	public function postReset(PasswordResetRequest $request)
 	{
 		


 		//This block check for existing acceptable request start

 		$requestedVal = DB::table('password_resets')->where('username',$request->username)->latest()->first();

 			
 		if($requestedVal == true)
 		{
 			$t1 =  $requestedVal->created_at;
 			$t2 = time();
 			$diff = $t2 - $t1;


 			if($diff < 86399 && $requestedVal->status == 0){
 				return redirect('/auth/login')->with('message','Your previous request is pending, please check your email');
 			}
 		}
 		//This block check for existing acceptable request end


 		$userInfos = User::where('username', $request->username)->get();

 		 if( $userInfos == false){
 		 	return redirect()->back()->with('message', 'User name is not available');
 		 }
 		 else
 		 {

 		 	foreach( $userInfos as $userInfo)
 		 	{
 		 		// return $userInfo->email;

 		 		if($userInfo->email != $request->email)
 		 		{
 		 			return redirect('/auth/login')->with('message', 'Invalid Email address');
 		 		}



 		 		$length = 32;

 		 		$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

 		 		$secret = $randomString;

 		 		DB::table('password_resets')->insert(
 		 		    ['email' => $request->email,
 		 		     'username' => $request->username,
 		 		     'secret'	=> $secret,
 		 		     'token'  => $request->_token,
 		 		     'created_at' => time() ]
 		 		);

 		 		// return $request->_token;

 		 		$time = DB::table('password_resets')->where('secret', $secret)->first()->created_at;
 		 		
 		 		$to = $request->email;
 		 		$email_header= 'FBO Corporation <no-reply@fbofund.com>';
 		 		$sub = "Password Reset";
 		 		$message = "Good Day<br/><br/>Dear FBO Member to set a new password for your Account, please click the following link: <br/> http://fbofund.com/member/resetpassword?code=".$secret."&waqt=".$time;
 		 		$headers = "From: $email_header\r\n";
 		 		$headers .= "Content-type: text/html\r\n";

 		 		mail($to, $sub, $message, $headers);

 		 		return redirect('/auth/login')->with('message', 'Please check email for resetting your Password');
 		 	}
 		 	
 		 }

 		return $request->email;


 	}





 	public function resetPassword(Request $request){
 		$code = $request->code;
 		$res = DB::table('password_resets')->where('secret', $code)->first();



 			if($res == false){
 				return view('user.passwordReset.expired');
 			}

		$uname = Crypt::encrypt(DB::table('password_resets')->where('secret', $request->code)->first()->username);

		// return $request->code;
 		$t1 =  $request->waqt;
 		$t2 = time();
 		$diff = $t2 - $t1;


 		if($diff > 86399){




 			DB::table('password_resets')->where('secret',$request->code)->delete();

 			return view('user.passwordReset.expired');
 		}
		

 		return view('user.passwordReset.reset', compact('uname'));
 	}


 	public function savePassword(Request $request)
 	{
 		// return $request->all();

 		if($request->password != $request->rpassword){
 			// return redirect()->back()->with('message','Both password should be same');
 			return redirect()->back()->with('warning', 'Confirm password should be same as password');
 		}
 		else{

 			$pass = bcrypt($request->password);
 			$username = Crypt::decrypt($request->username);

 			User::where('username', $username)->update(['password' => $pass]);

 			DB::table('password_resets')->where('username', $username)->update(['status'=>1]);
 			// DB::table('password_resets')->where('username',$username)->delete();
 			return view('user.passwordReset.success');

 		}

 	}



}
