<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Auth;
use App\User;
use App\Deposit;
use App\Transaction;
use App\paymentinfo;
use Carbon\Carbon;
use App\Roirecord;
use App\Account;
use App\Downline;
use App\Carry;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "hello";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();


        //first block is checking money transfer or not    
        if(!$request->PAYMENT_BATCH_NUM){
            return redirect('/user/deposit')->with('message','Sorry your transaction was unsuccessful. Please try again');
        }


        // Second block is for Account Activation
        if( $request->PAYMENT_ID == 'acc-activation')
        {



            $payerAccount = $request->PAYER_ACCOUNT;
            $payAmount = $request->PAYMENT_AMOUNT;
            $time      = $request->TIMESTAMPGMT;
            $batch_num = $request->PAYMENT_BATCH_NUM;
            Paymentinfo::insert([
                'user_id'           => Auth::id(),
                'member_account'    => $payerAccount,
                'amount'            => $payAmount,
                'paid_from'         => 'pm',
                'date'              => $time,
                'batch_num'         => $batch_num,
                'pmnt_type'         => 1,
                ]);

            Transaction::insert(
                    [
                    'tnx_id' => 'aa_'.rand(1,99999999),
                    'amount' => $payAmount,
                    'sign'   => '+',
                    'purpose' => 10,
                    // 'date'  => Carbon::now(),   
                    'user_id' => Auth::id(),
                    // 'related_id' =>Auth::user()->id
                    ]);

            User::where('id', Auth::id())

                    ->update(['status'=>1]);

            $this->updateMatchingQualify(Auth::id());        

            return redirect()->back()->with('Your  account activated successfully ');


        }

        if( $request->PAYMENT_ID == 'adeposit')
        {
            if(!$request->PAYMENT_BATCH_NUM){
               
                return redirect('/user/deposit')->with('message','Sorry your transaction was unsuccessful. Please try again');
                
            }



            $payerAccount = $request->PAYER_ACCOUNT;
            $payAmount = $request->PAYMENT_AMOUNT;
            $time      = $request->TIMESTAMPGMT;
            $batch_num = $request->PAYMENT_BATCH_NUM;
            Paymentinfo::insert([
                'user_id'           => Auth::id(),
                'member_account'    => $payerAccount,
                'amount'            => $payAmount,
                'paid_from'         => 'pm',
                'date'              => $time,
                'batch_num'         => $batch_num,
                'pmnt_type'         => 2,
                ]);

            // Account::where('user_id', Auth::id())->increment('balance',$payAmount);

            Deposit::insert([
                'user_id'       => Auth::id(),
                'amount'        => $payAmount,
                'pmnt_method'   => 'pm',
                'pmnt_account'  => $payerAccount,
                'rcvd_date'     => Carbon::now()

                     ]); 

            Transaction::insert(
                    [
                    'tnx_id' => 'nd_'.rand(1,99999999),
                    'amount' => $payAmount,
                    'sign'   => '+',
                    'purpose' => 11,
                    // 'date'  => Carbon::now(),   
                    'user_id' => Auth::id(),
                    // 'related_id' =>Auth::user()->id
                    ]); 

            $depositId = Deposit::where('user_id',Auth::user()->id)->first(); /*find deposit id for creating roi schedule*/

            $roiAmount = ($payAmount * 20)/100;
            
            for($i = 1; $i<=10; $i++){
                Roirecord::insert([
                        'deposit_id' => $depositId->id, 
                        'amount'    => $roiAmount,
                        'pmnt_date'=> Carbon::now()->addMonths($i),
                        'terms'     => $i,
                        'status'    => 0    
                    ]);
            } 
            // end for loop
            

            $referrarId = Auth::user()->referrar_id;
            $comissionAmount = (10*$payAmount)/100;    
            Account::where('user_id', $referrarId)->increment('balance', $comissionAmount);

            Transaction::insert(
            [
            'tnx_id' => 'drc_'.rand(1,99999999),
            'amount' => $comissionAmount,
            'sign'   => '+',
            'purpose' => 12,
            'date'  => Carbon::now(),   
            'user_id' => $referrarId,
            'related_id' =>Auth::user()->id
            ]);
               

               $this->carry(Auth::user()->id, Auth::user()->upline_id, $payAmount);

               return redirect('/user')->with('smessage', "Successfully Deposited");

            // return redirect()->back()->with('Successfully deposited your account');


        } // Third block is for deposit money with perfect money



        






        
    }/*store method end*/




        public function carry($uid = null, $upid = null, $amount=null )
        {
             
            // echo "<br/>".$upid . "<br/>";
              
            $uplineUserId = User::where('id', $upid)->first()->upline_id;
             
            $checkPosition = Downline::select('left_member_id', 'right_member_id')->where('user_id',$upid)->get();

              // Carry::where('user_id', $upid)->update(['right_carry'=>250]);       


             if($checkPosition){
                foreach ($checkPosition as $position) {
                     if($position->left_member_id == $uid && $position->right_member_id != $uid)
                     {
                        $left_carry = Carry::where('user_id', $upid)->first()->left_carry;
                        $newAmount = $left_carry + $amount;
                        Carry::where('user_id', $upid)->update(['left_carry'=>$newAmount]);
                     }
                     else
                     {
                        $right_carry = Carry::where('user_id', $upid)->first()->right_carry;
                        $newAmount = $right_carry + $amount;
                        Carry::where('user_id', $upid)->update(['right_carry'=>$newAmount]);
                     }
                }
             }
            
            // recursivly find upper lavel users
            if(!empty($uplineUserId)){

                $this->carry($upid, $uplineUserId, $amount);
            }
        }
        // carry function end

        
         public function updateMatchingQualify($uid)
         {
            $referrarId = User::where('id', $uid)->first()->referrar_id;

            $result = Carry::where('user_id', $referrarId)->first();

            if( $result->matching_qualify !=1 ){

                Carry::where('user_id', $referrarId)->update(['matching_qualify'=>1]);
                
            }

         }






























    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function accountActivation()
    {
        // return "Hi";
    }
}
