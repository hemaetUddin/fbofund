<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Deposit;
use App\Ccrequest;
use App\Roirecord;
use App\Account;
use App\Carry;
use App\Transaction;

use Auth;
use Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{
 

 	public function index()
 	{
 	   

 	   $depositInfo = Deposit::where('user_id', Auth::id())->get();
 	   // return count($depositInfo);
 	    if( count($depositInfo) > 0)
 	    {
 	    	$depositInfo = Deposit::where('user_id', Auth::id())->first();
 	    	$depAccount = $depositInfo->pmnt_account;



 	    	$roiSchedules = Roirecord::where('deposit_id', $depositInfo->id)->get();
 	    	 	     
 	    	 	      $startDate = strtotime(date('1-m-Y')); 	    	 	     
 	    	 	      $endDate = strtotime(date('t-m-Y'));  //create for one month
 	    	 	      
 	    	 	      // return date('t-m-Y'); //end of month

 	    	 	     $accounts = Account::where('user_id', Auth::user()->id)->first();
 	    	 	     $balance = number_format($accounts->balance,2);
 	    	 	     $carryInfo = Carry::where('user_id', Auth::id())->first();
 	    	 	     $drcIncome = Transaction::where('user_id', Auth::id())
 	    	 	                               ->where('tnx_id', 'like', 'drc%')
 	    	 	                               ->whereBetween('date', [$startDate, $endDate])->sum('amount');  

 	    	 	    $srcIncome = Transaction::where('user_id', Auth::id())
 	    	 	                               ->where('tnx_id', 'like', 'src%')
 	    	 	                               ->whereBetween ('date', [$startDate, $endDate])->sum('amount');

 	    	return view('profiles.profile', compact('depAccount','srcIncome','drcIncome'));

 	    }
 	    else
 	    {
 	    	$depAccount = 0;

 	    	// $roiSchedules = Roirecord::where('deposit_id', $depositInfo->id)->get();
 	    	 	     
 	    	 	     $startDate = strtotime(date('d-m-Y'));
 	    	 	     $endDate = strtotime(date('d-m-Y')) + 2591970; //create for one month
 	    	 	     $accounts = Account::where('user_id', Auth::user()->id)->first();
 	    	 	     $balance = number_format($accounts->balance,2);
 	    	 	     $carryInfo = Carry::where('user_id', Auth::id())->first();
 	    	 	     $drcIncome = Transaction::where('user_id', Auth::id())
 	    	 	                               ->where('tnx_id', 'like', 'drc%')
 	    	 	                               ->whereBetween('date', [$startDate, $endDate])->get();  

 	    	 	    $srcIncome = Transaction::where('user_id', Auth::id())
 	    	 	                               ->where('tnx_id', 'like', 'src%')
 	    	 	                               ->whereBetween ('date', [$startDate, $endDate])->sum('amount');

 	    	return view('profiles.profile', compact('depAccount','srcIncome'));
 	    }


 	    

 	    
 	}












 	public function userInfoupdate(Request $request){
 		// return $request->all();
 		User::where('id', $request->id)
 				->update([
 						'full_name' => $request->full_name,
 						'address'   => $request->address]);

 				return redirect()->back();


 	}

 	public function passwordChangeRequest(Request $request)
 	{
 		// return Auth::user()->password;
 		// return $request->new_pass;
 		// return Hash::make(123123);

 		if($request->new_pass != $request->re_pass){
 			return redirect()->back()->with('message','Both password should be same.');
 		}

 		$res = Hash::check($request->old_pass, Auth::user()->password);
 		if($res == 0)
 		{
 			return redirect()->back()->with('message','Old password does not match.');
 		}
 		else
 		{	
 			// $request->new_pass;
 			User::where('id', Auth::id())
 			->update(['password' => Hash::make($request->new_pass)]);
 			return redirect()->back()->with('smessage','Password changed successfully.');
 		}

 	}


 	public function pinChangeRequest( Request $request )
 	{
 		if( $request->old_pin != Auth::user()->pin)
 		{
 			return redirect()->back()->with('message','PIN does not match.');
 		}
 		else
 		{
 			User::where('id', Auth::id())
 					->update(['pin' => $request->new_pin]);

 			return redirect()->back()->with('message','PIN change successfully.');			
 		}
 	}


 	public function emailChangeRequest(Request $request)
 	{
 		// return $request->all();
 		$upline_user = User::where('id', Auth::user()->upline_id)->first()->username;
 		
 		if($request->cur_email != Auth::user()->email || $request->cur_email == '')
 		{
 			return redirect()->back()->with('message', 'Email address does not match.');
 		}
 		else if($request->upline_id != $upline_user)
 		{
 			return redirect()->back()->with('message', 'Please provide correct upline id.');	
 		}
 		else{
 			Ccrequest::insert([
 				'user_id' 		=> Auth::id(),
 				'upline_id'		=> Auth::user()->upline_id,
 				'email'			=> $request->cur_email,
 				'req_email'		=> $request->new_email,
 				'date'			=> Carbon::now()
 				]);
 			return redirect()->back()->with('message', 'Your request submitted for review and will be processed as soon as possible.');
 		}
 	}

 	public function phoneChangeRequest(Request $request)
 	{
 		// return $request->all();
 		$upline_user = User::where('id', Auth::user()->upline_id)->first()->username;

 		if($request->cur_phone != Auth::user()->phone_number || $request->cur_phone == '')
 		{
 			return redirect()->back()->with('message', 'Phone number does not match');
 		}
 		else if($request->upline_id != $upline_user)
 		{
 			return redirect()->back()->with('message', 'Please provide correct upline id');	
 		}
 		else{
 			Ccrequest::insert([
 				'user_id' 		=> Auth::id(),
 				'upline_id'		=> Auth::user()->upline_id,
 				'phone'			=> $request->cur_phone,
 				'req_phone'		=> $request->new_phone,
 				'date'			=> Carbon::now()
 				]);
 			return redirect()->back()->with('message', 'Your request submitted for review and will be processed as soon as possible.');
 		}

 	}








 	// Ajax functions


 	public function checkPassword($oldPassword)
 	{	
 		
 		// $userOldPassword = bcrypt($oldPassword);
 		/*$result = Hash::check( !'password', $oldPassword);
 		if($result == 0){
 			echo json_encode($userOldPassword);
 		}*/

 		/*$changedPass = Hash::make($oldPassword);

 		if( $changedPass != Auth::user()->password){
 			echo json_encode('Old password does not match');
 		}*/


 		/*if(! Hash::check($oldPassword, Auth::user()->password)){
 			echo json_encode('Old Password does not match');
 		}*/
 		echo json_encode($oldPassword);
 		return;

 		$res = Hash::check($oldPassword, Auth::user()->password);

 		if( $res == 0)
 		{
 			echo json_encode('false');
 		}/*else
 		{
 			echo json_encode('true');
 		}*/
 		

 		/*User::where('id', Auth::id())
 			->update(['password' => Hash::make($oldPassword)]);*/

 	}

 	public function checkPin($oldPin)
 	{
 		if( $oldPin != Auth::user()->pin)
 		{
 			echo json_encode('PIN does not match');
 		}

 	}

 	public function emailChange( $curEmail )
 	{
 		if( $curEmail != Auth::user()->email)
 		{
 			echo json_encode('Email address does not match');
 		}

 	}

 	public function phoneChange( $curPhone )
 	{
 		if( $curPhone != Auth::user()->phone_number)
 		{
 			echo json_encode('Phone number does not match');
 		}

 	}
}
