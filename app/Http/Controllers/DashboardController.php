<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


use App\User;
use App\Account;
use DB;


use Auth;

class DashboardController extends Controller
{
        

    /*public function index(User $user){

    	$userInfo = $user->find(Auth::user()->id);

    	if($userInfo->is_logged==1){
    		return redirect('dashboard');
    	}
       
       $userIp = $_SERVER['REMOTE_ADDR'];

       $user->where('id', Auth::user()->id)
                    ->update(['is_logged'=> 1, 'last_login_ip' => $userIp, 'last_login_time'=>Carbon::now()]);

       $accounts = Account::where('user_id', Auth::user()->id)->first();
        $balance = number_format($accounts->balance,2);             
       
       
        return view('dashboard.index', compact('balance'));
    }*/

  public function index()
  {
    if(Auth::user()->roles()->first()->name == 'admin')  
        {
          return redirect('/admin');
        }
      
    else if(Auth::user()->roles()->first()->name == 'user') 
      {
        return redirect('/user');
      }
  }

   


    

}
