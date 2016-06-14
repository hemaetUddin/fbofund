<?php 

namespace App\Helpers;

class AppHelper{

	public static function transactionType($trans_id){
	        $trans_type = [
	                1=>  'Step referral comission', //src
	                2=>  'Wallet withdrawn request', //wwr
	                3=>  'Withdrawn Processing Fee', //wpf
	                4=>  'Return of Invest', 
	                5=>  'Wallert to Wallet',
	                6=>  'ROI to ROI',
	                7=>  'ROI to wallet',
	                8=>  'Withdrawn',
	                9=>  'Reject Withdrawal',
	                10=> 'Account activation',
	                11=> 'New deposit',
	                12=> 'Direct referral comission', //drc
	                13=> 'ROI to Wallet processing fee',
	                14=> 'ROI Payment',
	                15=> 'ROI withdrawn request', //rwr
	                16 => 'Accepted wallet withdrawl', // Only uses for accepted wallet withdrawn request not for new transaction
                    17 => 'Accepted roi withdrawl' // Only uses for accepted roi withdrawn request not for new transaction
	        ];
	        return $trans_type[$trans_id];

	}
}

					