<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Deposit;
use Auth;
use App\Withdrawal;
use Carbon\Carbon;

class AdminDetailsController extends Controller
{
    


    public function totalusers()
    {
    	$today = date('Y-m-d', strtotime(Carbon::now()->today()));
    	
    	$totalRegUsers= User::where('signup_date', 'LIKE',  $today.'%')->get();

    	return view('admin.dashdetails.totalusers', compact('totalRegUsers'));
    }

    public function totaldeposit()
    {
    	$today = date('Y-m-d', strtotime(Carbon::now()->today()));
    	
    	$totalDeposits = Deposit::where('rcvd_date', 'LIKE', $today.'%')->get();		

    	return view('admin.dashdetails.totaldeposit',compact('totalDeposits'));
    }

    public function totalwithdrawl()
    {
    	$today = date('Y-m-d', strtotime(Carbon::now()->today()));
    	
    	$totalWithdRequests = Withdrawal::where('request_date', 'LIKE', $today.'%')->get();
    	
    	return view('admin.dashdetails.totalwithdrawl', compact('totalWithdRequests'));
    }
}
