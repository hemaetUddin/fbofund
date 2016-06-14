<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;

use App\Http\Requests\UserRegRequest;
use App\Http\Controllers\Controller;


use App\Account;
use App\Carry;
use App\Downline;
use App\User;
use Carbon\Carbon;
use App\Transaction;
use App\Role;
use App\Deposit;
use App\Roirecord;
use App\Support;
use Auth;
use DB;
use App\Withdrawal;
use Hash;


class UserController extends Controller
{

    public $uplineId;
    public $requestValue;

    public $leftCount = 0;
    public $rightCount = 0;

    public $transactionDetails = [];

    

   





    public function index ( User $user )
    {
      // return Auth::id();
      // return $this->myTransActions(6, $this->transactionDetails);

                
        $userInfo = $user->find(Auth::user()->id);

        /*if($userInfo->is_logged===1){
          return redirect('/user');
        }*/
         
         $userIp = $_SERVER['REMOTE_ADDR'];

         $user->where('id', Auth::user()->id)
                      ->update(['is_logged'=> 1, 'last_login_ip' => $userIp, 'last_login_time'=>Carbon::now()]);


        

        $depositId = Deposit::where('user_id', Auth::id())->first();

        if($depositId != null){
            $depositAmount = $depositId->amount;

        
        $roiSchedules = Roirecord::where('deposit_id', $depositId->id)->get();
        
        $startDate = strtotime(date('d-m-Y'));
        $endDate = strtotime(date('d-m-Y')) + 86399;
        $accounts = Account::where('user_id', Auth::user()->id)->first();
        $balance = number_format($accounts->balance,2);
        $carryInfo = Carry::where('user_id', Auth::id())->first();
        $drcIncome = Transaction::where('user_id', Auth::id())
                                  ->where('tnx_id', 'like', 'drc%')
                                  ->whereBetween('date', [$startDate, $endDate])->sum('amount');  

       $srcIncome = Transaction::where('user_id', Auth::id())
                                  ->where('tnx_id', 'like', 'src%')
                                  ->whereBetween ('date', [$startDate, $endDate])->sum('amount');

        
        $withdrawInfos = Withdrawal::where('user_id', Auth::id())->get(); 

        $transactionInfos = Transaction::where('user_id', Auth::id())
                            ->whereNotIn('purpose',[3,13])->get();   

        $lmAndRm = Downline::where('user_id', Auth::id())->first();

        $leftMemID = $lmAndRm->left_member_id;
        $rightMemID = $lmAndRm->right_member_id;
        
        if($lmAndRm->left_member_id == 0){
          $leftUserName = 0;
        }
        else{
          $leftUserName    = User::where('id', $lmAndRm->left_member_id)->first()->username;  
        }

        if($lmAndRm->right_member_id == 0){
          $rightUserName = 0;
        }else {
          $rightUserName   = User::where('id', $lmAndRm->right_member_id)->first()->username;                                          
        }      
        

        $datas = [
                    $leftUserName,
                    $rightUserName,
                    $carryInfo->left_carry,
                    $carryInfo->right_carry,
                    $accounts->balance,
                    $accounts->roi_balance,
                    $drcIncome,
                    $srcIncome,
                    $leftMemID,
                    $rightMemID                    
                ];


            
         $leftAndRightID = [ 'leftId'=>$leftMemID, 'rightId' => $rightMemID ]; 



        return view('user.index', compact('balance','roiSchedules','depositAmount','datas','withdrawInfos','transactionInfos', 'leftAndRightID'));

        }
        else
        {
             $startDate = strtotime(date('d-m-Y'));
             $endDate = strtotime(date('d-m-Y')) + 86399;
             $accounts = Account::where('user_id', Auth::user()->id)->first();
             $balance = number_format($accounts->balance,2);
             $carryInfo = Carry::where('user_id', Auth::id())->first();
             $drcIncome = Transaction::where('user_id', Auth::id())
                                       ->where('tnx_id', 'like', 'drc%')
                                       ->whereBetween('date', [$startDate, $endDate])->sum('amount');  

            $srcIncome = Transaction::where('user_id', Auth::id())
                                       ->where('tnx_id', 'like', 'src%')
                                       ->whereBetween ('date', [$startDate, $endDate])->sum('amount');

             
             $lmAndRm = Downline::where('user_id', Auth::id())->first();                    
             $withdrawInfos = Withdrawal::where('user_id', Auth::id())->get(); 
             $transactionInfos = Transaction::where('user_id', Auth::id())
                            ->whereNotIn('purpose',[3,13])->get(); 

            $leftMemID = $lmAndRm->left_member_id;
            $rightMemID = $lmAndRm->right_member_id;                

             if($lmAndRm->left_member_id == 0){
               $leftUserName = 'Blank';
             }
             else{
               $leftUserName    = User::where('id', $lmAndRm->left_member_id)->first()->username;  
             }

             if($lmAndRm->right_member_id == 0){
               $rightUserName = 'Blank';
             }else {
               $rightUserName   = User::where('id', $lmAndRm->right_member_id)->first()->username;                                          
             }      
             

             $datas = [
                         $leftUserName,
                         $rightUserName,
                         $carryInfo->left_carry,
                         $carryInfo->right_carry,
                         $accounts->balance,
                         $accounts->roi_balance,
                         $drcIncome,
                         $srcIncome, 
                         $leftMemID,
                         $rightMemID                   
                     ];

            $roiSchedules = 0;  

            // return Carbon::now();


             $supports = Support::where('user_id', Auth::id())
                                  ->where('status',1)->get(); 
            
            return view('user.index', compact('balance','datas','roiSchedules','withdrawInfos','transactionInfos','supports'));
        }


    }


    public function postRegister()
    {
    	return view('user.register');
    }


/**
* Count members
* Count left_member recursivly and as well as right_members also 
* From downline table
*@return integer
*/

    public function countMembers($uid)
    {

        $downTable = Downline::where('user_id', $uid)->first();
          if($downTable){

          if($downTable->left_member_id !=0){
            // $this->leftIdList .= $downTable->left_member_id;
            array_push($this->leftIdList, $downTable->left_member_id);
          }
          if($downTable->right_member_id != 0){
            // $this->rightIdList .= $downTable->right_member_id;
            array_push($this->rightIdList, $downTable->right_member_id );
          }

          if($downTable->left_member_id !=0){
            $this->countMembers($downTable->left_member_id);
          }
          if($downTable->right_member_id !=0){
            $this->countMembers($downTable->right_member_id);
          }

          $total = array_merge($this->leftIdList, $this->rightIdList);

          return count($total);

          }



    }


 


/**
* Method Name :Store
* Insert data to User Table and consequencesly insert to Account, Carries and Downline table
*
*
*/
    public function store(UserRegRequest $request, User $user){
      // return $request->all();
    	
         $uplineUser = User::where('username',$request->upline_id)->first();
         $referrarUser = User::where('username', $request->referrar_id)->first();
         $uplineId = $uplineUser->id; 
         $requestValue = $request->placement;
         // return $request->full_name . "++". preg_replace('/\s+/', '', strtolower($request->username));
         // $username = 
        
    	$address = $request->address1 . ",". $request->address2;
      $pin = rand(1,99999999);
    	// return 
    	$user->insert([
    	    [
    	    'username' => preg_replace('/\s+/', '', strtolower($request->username)),
    	    'full_name' => $request->full_name,
    	    'gender' => $request->gender,
            'email' => $request->email,

    	    'password' => bcrypt($request->password),
    	    'remember_token' => $request->_token,
    	    'address' => $address,

    	    'phone_number' => $request->phone_number,
    	    'country' => $request->country,
            'account_no' => rand(1,99999999),
    	    'referrar_id' => $referrarUser->id,

    	    'upline_id' => $uplineUser->id,
    	    'pin' => $pin,
    	    // 'is_block' => 'n',

    	    // 'block_issue' => 'nothing',
    	    // 'last_login_ip' => '123.1236.251',
    	    // 'is_logged' => '1',

    	    // 'status' => 1,
    	    'signup_date' => Carbon::now(),
    	    'last_login_time' => Carbon::now()
    	    ]
    	]);

        $lastRegUser = $user->where('username', preg_replace('/\s+/', '', strtolower($request->username)))->first();        
        $role = Role::where('id',3)->first();
        $lastRegUser->assign($role);
        Account::insert([
            'balance' => 0,
            'roi_balance' => 0,
            'user_id' => $lastRegUser->id,
            'acc_type' =>'0'
            ]);

        Carry::insert([
            'user_id' => $lastRegUser->id,
            'left_carry' => 0,
            'right_carry' => 0,
            'matching_qualify' =>0
            ]);

        Downline::insert([
            'user_id' => $lastRegUser->id,
            'left_member_id' => 0,
            'right_member_id' =>0
            ]);

        /*Downline::where('user_id', $uplineUser->id)
                    ->update(['right_member_id' => $request->placement]);*/


        /*return $downLineTable = Downline::where('user_id', $uplineId)->first();
        if($downLineTable->left_member_id == 0 && $request->placement != 'right'){
                    Downline::where('user_id', $uplineUser->id)
                                ->update(['left_member_id' => $lastRegUser->id]);  
                }
        else
                {
                   Downline::where('user_id', $uplineUser->id)
                    ->update(['right_member_id' => $lastRegUser->id]); 
                }
                */

              
        $position = preg_replace('/\s+/', '', strtolower($requestValue))."_member_id";
        Downline::where('user_id', $uplineUser->id)
                    ->update([$position => $lastRegUser->id]);
                    
                    // $data = ['s','t','t','p'];

                    $to = $request->email;
                    $email_header= 'FBO Corporation <no-reply@fbofund.com>';
                    $sub = "Welcome to FBO Corporation";
                    $message = "<b>Dear New FBO Member</b>, <br/><br/>Your account has been created in FBO Corporation system.<br/><br/>From now, you are able to access the FBOC Member area and start using your account to earn with FBOC. <br/><br/><br/>Your Member information given bellow: <br/><br/><br/><b>Account name: </b>". $request->full_name ."<br/><br/><b>User name: </b>". $request->username."<br/><br/><b>Password: </b>". $request->password."<br/><br/><b>PIN Code: </b>".$pin."<br/><br/><br/><br/> Please use these credential to login your personal area.<br/><br/>Click this link: http://fbofund.com/member/user to login.<br/><br/><br/>Thank you for creating account in FBO Corporation!<br/><br/><br/><br/>Support Manager,<br/>FBO Corporation,<br/>CA, USA<br/><br/>********************************************************************************************************************************<br/><br/> This is an automated email - Please do not reply. <br/><br/>This mailbox is not monitored and you will not receive a response<br/><br/<br/>********************************************************************************************************************************* ";
                    $headers = "From: $email_header\r\n";
                    $headers .= "Content-type: text/html\r\n";

                    mail($to, $sub, $message, $headers);

      
    	return redirect()->back()->with('smessage','Your account created Successfully! Check your email to find your login credential.');
    }







    
    public function getBalance(){
    	return "User Balance Page";
    }

    public function checkUserLive(User $user, $uname=null, Request $request){
        $userInfo = User::where('username', $uname)->first();

        // echo $userId;
        // echo json_encode($userInfo->username);

        // if(Request::ajax()) {
        //       $data = Input::all();
        //       print_r($data);
        //     }

        if (User::where('username', $uname)->exists())
         {
           echo json_encode("exist");
         }
        else
        {
            echo json_encode("is available" ); 
        }
        
    }

    public function checkReferrar( $referralId =null){
        

        if (User::where('username', $referralId)->exists())
         {
           echo json_encode("This is Valid id");
         }
        else
        {
            echo json_encode( "Please enter a valid ID!" ); 
        }

    }

    // check Referrar End

    

    /**
    * Check for user existance and brought downline left right
    * Query build
    *
    * @return array[]
    */


    public function checkUplineUser($uplineId =null){
        

       $result =[];

       if (User::where('username', $uplineId)->exists())
         {
           array_push($result, "is available");
           
         }
        else 
        {
            echo json_encode("Invalid Upline ID");
            return;           
        }
        
        $userInfo = User::where('username', $uplineId)->first();

            if($userInfo->id){
                $downLineTableRow = Downline::where('user_id', $userInfo->id)->first();
                $left_member_id = $downLineTableRow->left_member_id;
                $right_member_id = $downLineTableRow->right_member_id;

                    if($left_member_id == 0 && $right_member_id == 0)
                    {
                        array_push($result, "Left , Right");
                    }
                    elseif($left_member_id != 0 && $right_member_id == 0 )
                    {
                        array_push($result, "Right");   
                    }
                    elseif($left_member_id == 0 && $right_member_id != 0 )
                    {
                        array_push($result, "Left");   
                    }
                    else{
                        array_push($result, "No free position here. Please try another upline id");
                    }

                
            }else{
                array_push($result, "Not Valid user found");
            }
        
        echo json_encode($result);

    }

    // check upline user funcion end

    /**
     * payFromWallet
     * Process on user activation from wallet money
     *
     *@return String
     */

    public function payFromWallet(){



        $accountTable = Account::where('user_id',Auth::user()->id)->first();
        if($accountTable->balance < 25 ){
            return redirect()->back()->with('message' ,'You have not sufficent balance');
        }
        else
        {
            $newBalance = $accountTable->balance-25;
            Account::where('user_id', Auth::user()->id)->update(['balance'=>$newBalance]);
            Transaction::insert(
            [
            'tnx_id' => 'aa_'.rand(1,99999999),
            'amount' => 25,
            'sign'   => '-',
            'purpose' => 10,
            'date'  => Carbon::now(),   
            'user_id' => Auth::user()->id,
            // 'related_id' =>22
            ]);

            User::where('id',Auth::user()->id)->update(['status'=> 1]);

            $this->updateMatchingQualify();


            return redirect()->back()->with('smessage' ,'Successfully Activated');
        }
    }


        // Updating Matching Qualify start
        /**
        * Update matching qualify depends on account activation
        *
        *
        * @return boolean
        */
        public function updateMatchingQualify()
        {
            
            $referrarId = Auth::user()->referrar_id;

            $carriesInfo = Carry::where('user_id', $referrarId)->first();

            if( $carriesInfo->matching_qualify !=1 )
            {
                Carry::where('user_id', $referrarId)->update(['matching_qualify'=>1]);
            }
                           
        }
        // Updating Matching Qualify end




    


    /**
    * myTransactions this function called in index method
    *
    * @return String
    *
    */

    public function myTranssActions($uid, $arry)
    {
      $this->transactionType(12);
     $transactions =  Transaction::where('user_id',$uid)->get();

      
      foreach( $transactions as $transaction)
      {
         $arry[] .= $transaction->tnx_id;
         $arry[] .= $transaction->amount;
         $arry[] .= $this->transactionType($transaction->purpose);
         $arry[] .= $transaction->date;
      }

      return $arry;

    }





/**
* transactionType()
*
*
*@return string
*/

    public function transactionType($trans_id){
            $trans_type = [
                    1=>  'Step referral comission',
                    2=>  'Wallet Withdrawn request',
                    3=>  'Withdrawn Processing Fee',
                    4=>  'Return of Invest',
                    5=>  'Wallert to Wallet',
                    6=>  'ROI to ROI',
                    7=>  'ROI to wallet',
                    8=>  'Withdrawn',
                    9=>  'Reject Withdrawal',
                    10=> 'Account activation',
                    11=> 'New deposit',
                    12=> 'Direct referral comission',
                    13=> 'ROI to Wallet processing fee',
                    14=> 'ROI Payment',
                    15 => 'ROI Withdrawn request',
                    16 => 'Accepted wallet withdrawl',
                    17 => 'Accepted roi withdrawl'
            ];
            return $trans_type[$trans_id];

    }

    
   










}