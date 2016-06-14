<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\paymentinfo;
use App\Transaction;
use App\Withdrawal;
use Carbon\Carbon;


class WithdrawalPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::logout();
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
        

         

        if(!$request->PAYMENT_BATCH_NUM){
            return redirect('/admin/withdrawal')->with('message','Sorry your transaction was unsuccessful. Please try again');
        }

        $tnx_id_prefix = substr($request->PAYMENT_ID, 0,3); 
        $tnxId = $request->PAYMENT_ID;

        if( $tnx_id_prefix == 'wwr' )  //if wallet withdrawl request
        {
            $payeeAccount = $request->PAYEE_ACCOUNT;
            $payAmount = $request->PAYMENT_AMOUNT;
            $time      = $request->TIMESTAMPGMT;
            $batch_num = $request->PAYMENT_BATCH_NUM;
            Paymentinfo::insert([
                'user_id'           => Auth::id(),
                'member_account'    => $payeeAccount,
                'amount'            => $payAmount,
                'paid_from'         => 'pm',
                'date'              => $time,
                'batch_num'         => $batch_num,
                'pmnt_type'         => 3,
                ]);

            Transaction::where('tnx_id', $tnxId)->update(['purpose' => 16]);
            Withdrawal::where('tnx_id', $tnxId)->update([ 'response_date' => Carbon::now(), 'status' => 1]);

            return redirect('/admin/withdrawal')->with('smessage', 'Successfully balance transferred');
        }
        else{

            $payeeAccount = $request->PAYEE_ACCOUNT;
            $payAmount = $request->PAYMENT_AMOUNT;
            $time      = $request->TIMESTAMPGMT;
            $batch_num = $request->PAYMENT_BATCH_NUM;
            Paymentinfo::insert([
                'user_id'           => Auth::id(),
                'member_account'    => $payeeAccount,
                'amount'            => $payAmount,
                'paid_from'         => 'pm',
                'date'              => $time,
                'batch_num'         => $batch_num,
                'pmnt_type'         => 4,
                ]);

            Transaction::where('tnx_id', $tnxId)->update([ 'purpose' => 17 ]);
            Withdrawal::where('tnx_id', $tnxId)->update([ 'response_date' => Carbon::now(), 'status' => 1 ]);

            return redirect('/admin/withdrawal')->with('smessage', 'Successfully balance transferred');

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
}
