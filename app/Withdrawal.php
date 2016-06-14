<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use App\Account;
use App\Transaction;

class Withdrawal extends Model
{
    



	 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'withdrawals';

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['name', 'email', 'password'];
       protected $fillable = ['amount', 'wdrl_chrg', 'amount_type', 'request_date', 'response_date', 'user_id', 
                              'status', 'withdraw_to','tnx_id','remark'];

    


/*
   +++++++++++++++++++++++++++++
   ## Start Business Logics or functions which called in Account Controller
   +++++++++++++++++++++++++++++
*/

/**
* withdrawRequestProcess
* This method called in Account Controller
* Insert into withdraws table, inset transaction
* @return String
*/


public function withdrawRequestProcess($balanceType, $requestAmount, $account)
{
	// return $balanceType;
	$availableBalance = Account::where('user_id', Auth::id())->first();
	$wbBalance  = $availableBalance->balance - ( $requestAmount * .05 ); // Balance after deduct charge 5% of withdrawal request amount
	$roiBalance = $availableBalance->roi_balance - ( $requestAmount * .05 );
	$deductBalance = ( $requestAmount + $requestAmount * .05 );

		


		if( $balanceType == 1 )
		{
			if( $requestAmount > $wbBalance )
				{
					return redirect()->back()->with('message', 'Insufficient Balance');
				}
			else{

				$tnx_id = 'wwr_'.rand(1,99999999);
				Withdrawal::insert([
					'amount' 		=> $requestAmount,
					'wdrl_chrg'		=> ($requestAmount * .05),
					'amount_type'  	=> $balanceType,
					'request_date'	=> Carbon::now(),
					'user_id'		=> Auth::id(),
					'withdraw_to'   => $account,
					'tnx_id'		=> $tnx_id
					]);

				 Account::where('user_id', Auth::id())
				 ->decrement('balance', $deductBalance);

				  Transaction::insert(
					[
					'tnx_id' => $tnx_id,
					'amount' => $requestAmount+($requestAmount*.05),
					'sign'   => '-',
					'purpose' => 2,
					// 'proce_fee'=> ($requestAmount*.05),
					'date'  => Carbon::now(),   
					'user_id' => Auth::user()->id,
					// 'related_id' =>22
					]);	

					return redirect()->back()->with('smessage', 'Your withdrawal request submitted. Please allow us 24 hours to process your request.');		
			};
		}
		else
		{	

			if( $requestAmount > $roiBalance )
				{
					return redirect()->back()->with('message', 'Insufficient balance.');

				}
			else{

				$tnx_id = 'rwr_'.rand(1,99999999);

				Withdrawal::insert([
					'amount' 		=> $requestAmount,
					'wdrl_chrg'		=> ($requestAmount * .05),
					'amount_type'  	=> $balanceType,
					'request_date'	=> Carbon::now(),
					// 'response_date' => 0
					'user_id'		=> Auth::id(),
					// 'status'		=> 0
					'withdraw_to'   => $account,
					'tnx_id'		=> $tnx_id
					]);

				 Account::where('user_id', Auth::id())
				 ->decrement('roi_balance', $deductBalance);

				 Transaction::insert(
					[
					'tnx_id' => $tnx_id,
					'amount' => $requestAmount+($requestAmount * .05),
					'sign'   => '-',
					'purpose' => 15,
					// 'proce_fee'=> ($requestAmount*.05),
					'date'  => Carbon::now(),   
					'user_id' => Auth::user()->id,
					// 'related_id' =>22
					]);

					return redirect()->back()->with('smessage', 'Your withdrawal request submitted. Please allow us 24 hours to process your request.');				 
					
			};

		}



}








}
