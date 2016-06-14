<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Deposit;
use App\Withdrawal;
use App\Transaction;
use App\Account;
use Carbon\Carbon;
use Auth;
use DB;

class AdminReportsController extends Controller
{
    




    public function getDepositReport()
    {
    	$depositReports = Deposit::get();

    	$total = Deposit::get()->sum('amount');

    	return view('admin/reports/depositReport', compact('depositReports', 'total'));

    }







    public function getWithdrawlReport()
    {
    	$withdrawlReports = Withdrawal::get();

    	$acceptedTotal = Withdrawal::where('status',1)->get()->sum('amount');

    	$canceledTotal = Withdrawal::where('status',2)->get()->sum('amount');

    	$pendingTotal = Withdrawal::where('status',0)->get()->sum('amount');


    	$total = [$acceptedTotal,$pendingTotal,$canceledTotal];

    	return view('admin/reports/withdrawlReport', compact('withdrawlReports', 'total'));
    }







    public function getTransactionReport()
    {
    	$transactionReports = Transaction::get();

    	$total = Transaction::get()->sum('amount');

    	return view('admin/reports/transactionReport', compact('transactionReports','total'));
    }






    public function getDrcReport()
    {
    	
    	$drcReports = Transaction::where('tnx_id', 'LIKE', 'drc%')->get();

    	$total = Transaction::where('tnx_id', 'LIKE', 'drc%')->get()->sum('amount');


    	return view('admin/reports/drcReport', compact('drcReports','total'));
    }






    public function getSrcReport()
    {
    	
    	$srcReports = Transaction::where('tnx_id', 'LIKE', 'src%')->get();

    	$total = Transaction::where('tnx_id', 'LIKE', 'src%')->get()->sum('amount');

    	return view('admin/reports/srcReport', compact('srcReports', 'total'));

    }






    public function getPaymentReport()
    {
    						    

		 $monthlyPayments = DB::table('transactions as t')
    	                ->select(
    	                	array( 	DB::Raw('sum(t.amount) as totalAmount'),
    	                			DB::Raw('t.purpose as purpose'),
    	                			DB::Raw('count(t.purpose) as countPurpose'),
    	                		   	DB::Raw('DATE(t.date) as day')))
    	                ->groupBy(['day', 'purpose'])
    	                ->whereIn('purpose',[1,12,17])
    	                ->orderBy('t.date','DESC')
    	                ->get();

    	$drc = Transaction::where('purpose',12)->get()->sum('amount');
    	$src = Transaction::where('purpose',1)->get()->sum('amount');
    	$roi = Transaction::where('purpose',17)->get()->sum('amount');

    	$total = [ $drc, $src, $roi];

    	return view('admin/reports/paymentReport', compact('monthlyPayments','total'));
    }
}
