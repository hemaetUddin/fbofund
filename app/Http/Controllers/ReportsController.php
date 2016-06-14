<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Deposit;
use App\User;
use App\Withdrawal;
use App\Transaction;
use App\Downline;



use Auth;

class ReportsController extends Controller
{

	public $totalEarned;
	public $tableString = '';
	public $i = 1;
   





   public function getDepositHistory()
   {

   	if(Auth::user()->status == 0){
   		return redirect()->back()->with('message','Please Activate your account first.');
   	}

   	$depositHistory = Deposit::where('user_id', Auth::id())->first();

   	// return count($depositHistory);
   	// return view('user.reports.deposithistory', compact('depositHistory'));

   	if( count($depositHistory) != 0)
   	{
   			// return $depositHistory;
   		return view('user.reports.deposithistory', compact('depositHistory'));
   		
   	}
   	else
   	{
   		$depositHistory = 0;
   		return view('user.reports.deposithistory', compact('depositHistory'));
   	}

   	
   }



   public function getWithdrawalHistory()
   {
   	 if(Auth::user()->status == 0){
   	 	return redirect()->back()->with('message','Please Activate your account first.');
   	 }

   	 $withdrawInfos = Withdrawal::where('user_id', Auth::id())->get();

   	 return view('user.reports.withdrawalhistory', compact('withdrawInfos'));
   }







   public function getTransactionHistory()
   {
   		if(Auth::user()->status == 0){
   			return redirect()->back()->with('message','Please Activate your account first.');
   		}

   		$transactionInfos = Transaction::where('user_id', Auth::id())
                              ->whereNotIn('purpose',[3,13])->get();

      
   		return view('user.reports.transactionhistory', compact('transactionInfos','userName'));
   }

   





   public function getEarningDetails()
   {

   	
      $earningInfos = Transaction::where('user_id' ,Auth::id())
      							->whereIn('purpose', [1,4,12])->get(); 

      foreach( $earningInfos as $earn)
   		{
   			$this->total($earn->amount);
   		}

   		$total = $this->totalEarned;



   	return view('user.reports.earningdetails', compact('earningInfos', 'total'));
   }








   public function getDrcReport()
   {
   		$drcInfos = Transaction::where('user_id', Auth::id())
   									->where('tnx_id','LIKE','drc%')->get();
		foreach( $drcInfos as $drc)
   		{
   			$this->total($drc->amount);
   		}

   		$total = $this->totalEarned;   									

   		return view('user.reports.drcreport', compact('drcInfos', 'total'));
   }







   public function getSrcReport()
   {
   		$srcInfos = Transaction::where('user_id', Auth::id())
   									->where('tnx_id','LIKE','src%')->get();
		foreach( $srcInfos as $src)
   		{
   			$this->total($src->amount);
   		}

   		$total = $this->totalEarned;   									

   		return view('user.reports.srcreport', compact('srcInfos', 'total'));
   }







   public function getDownlineReport()
   {
   	
   		/*$deposit = Deposit::where('user_id', 6)->first();	
         if(count($deposit) >0 ){
                 return  $this->tableString .= $deposit->amount .'</td></tr>';   
               }
               else{
                return  $this->tableString .= "hello</td></tr>";
               }*/

   		
   		// return count($deposit);

   		$this->leftAndRightMembers(Auth::id());
   		
   		$tdata = $this->tableString;




   	return view('user.reports.downline', compact('tdata'));
   }



   public function leftAndRightMembers($uid, $i=1)
   {
   		// $i=1;

   		$leftAndRighUser = Downline::where('user_id', $uid)->first();   		
   		

   		if($leftAndRighUser->left_member_id && $leftAndRighUser->left_member_id != 0 )
   		{
   			
   			$userName = User::where('id', $leftAndRighUser->left_member_id)->first()->username;
   			$this->tableString .= '<tr><td>'.$i++ .'</td><td>'.$userName .'</td><td>';
   			
   			$userInfo = User::where('id', $uid)->first();

   			$referrar = User::where('id', $userInfo->referrar_id)->first()->username;

   			$this->tableString .= $referrar.'</td><td>--</td><td>--</td><td>'.$userInfo->signup_date.'</td><td>';

   			$deposit = Deposit::where('user_id', $leftAndRighUser->left_member_id)->first();	
   			
               if(count($deposit) > 0 ){
                  $this->tableString .= 'USD '. number_format($deposit->amount,2) .'</td></tr>';   
               }
               else{
                  $this->tableString .= "--</td></tr>";
               }

   		}

   		if($leftAndRighUser->right_member_id && $leftAndRighUser->right_member_id != 0 )
   		{
   			// $this->tableString .= '<tr><td>'.$i++.'</td><td> L M </td><td>L Re </td><td>'.$leftAndRighUser->right_member_id .'</td><td>';
   			$userName = User::where('id', $leftAndRighUser->right_member_id)->first()->username;

   			$this->tableString .= '<tr><td>'. $i++ .'</td><td> -- </td><td> -- </td><td>'.$userName.'</td><td>';
   			
   			$userInfo = User::where('id', $uid)->first();
   			$referrar = User::where('id', $userInfo->referrar_id)->first()->username;

   			$this->tableString .= $referrar.'</td><td>'.$userInfo->signup_date.'</td><td>';

   			$deposit = Deposit::where('user_id', $leftAndRighUser->right_member_id)->first();
   			
            if(count($deposit) >0 ){
               $this->tableString .= 'USD '. number_format($deposit->amount,2) .'</td></tr>';   
            }
            else{
               $this->tableString .= "--</td></tr>";
            }	

	   			

   		}



   		if($leftAndRighUser->left_member_id != 0)
   		{
   			$this->leftAndRightMembers($leftAndRighUser->left_member_id, $i++);
   		}
   		if($leftAndRighUser->right_member_id != 0)
   		{
   			$this->leftAndRightMembers($leftAndRighUser->right_member_id, $i++);
   		}
   		
   }







   /**
   * total function called in others method where to get total amount
   * getEarningDetail, getDrcReport, getSrcReport
   * @prams Amount
   *
   * @return integer
   */
   public function total($amount)
   {
   	 $this->totalEarned += $amount;
   }


   



}
