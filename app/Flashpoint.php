<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Carry;
use App\Account;
use App\Transaction;
use App\Flashpoint;
use Carbon\Carbon;

class Flashpoint extends Model
{

 
	// public $lavels = [300, 600, 1200, 2500, 5000, 10000, 20000];

	public $lavels = [300, 700, 1000, 2000, 4000, 10000];

	
	/**
	* generateReferralPoints this function called from Referral Controller
	* 5% comission generate
	* lowar side on carries table set to 0 and deduct amount from strong side
	* insert to transaction table and flash points table
	* @return String
	*/


	public function generateReferralPoints()
	{
		
		$matchCarries = Carry::where('left_carry', '!=', 0)
								->where('matching_qualify', 1)
								->where('right_carry', '!=', 0)->get();

		// $left_carry = '';
		// $right_carry = '';
		$totalSrcUser = count($matchCarries);			
		$totalAmount = 0;	

		if($totalSrcUser == 0)
			{
				return redirect()->back()->with('messageAlert', 'No matching found for any user');
			}
		else
			{
				foreach( $matchCarries as $matches)
					{
						$left_carry  = $matches->left_carry;
						$right_carry = $matches->right_carry;
						

						if($left_carry < $right_carry)
							{
								// return "L".$left_carry;
								$matchedValue = $this->checkLavel($this->lavels, $left_carry);
								$comission =  $matchedValue * .1;
								$totalAmount += $comission;

								if($matchedValue)
									{
										// return "Yes got the value left";
										// return $matches->user_id;
										$deletedLeftCarry = $matches->left_carry - $matchedValue; 
										$restRightCarry = $matches->right_carry - $matchedValue;
										Carry::where('user_id',$matches->user_id)
												->update([
													'left_carry' => 0,
													'right_carry' => $restRightCarry
													]);

										Account::where( 'user_id', $matches->user_id )	
												 ->increment('balance', $comission);	

										Transaction::insert(
										[
										'tnx_id' => 'src_'.rand(1,99999999),
										'amount' => $comission,
										'sign'   => '+',
										'purpose' => 1,
										'date'  => Carbon::now(),   
										'user_id' => $matches->user_id,
										// 'related_id' =>22
										]);	

										Flashpoint::insert(
											[
											'flash_points' 		=> $deletedLeftCarry,
											'user_id'		  	=> $matches->user_id,  
											'flash_position' 	=> 'L',  
											'date'		  		=> Carbon::now()
											]	
										);

										// return redirect()->back()->with('message', 'Step referral comission generated successfully');


									}
								else
									{
										return "No matching are available";
									}
							}
						else
							{
								// return "R".$right_carry;
								$matchedValue = $this->checkLavel($this->lavels, $right_carry);
								$comission =  $matchedValue * .1;
								$totalAmount += $comission;
								if($matchedValue)
									{
										// return "Yes got the value right";
										$deletedRightCarry = $matches->right_carry - $matchedValue; 
										$restLeftCarry = $matches->left_carry - $matchedValue;
										Carry::where('user_id',$matches->user_id)
												->update([
													'left_carry' => $restLeftCarry,
													'right_carry' => 0
													]);

										Account::where( 'user_id', $matches->user_id )	
												 ->increment('balance', $comission);	

										Transaction::insert(
										[
										'tnx_id' => 'src_'.rand(1,99999999),
										'amount' => $comission,
										'sign'   => '+',
										'purpose' => 1,
										'date'  => Carbon::now(),   
										'user_id' => $matches->user_id,
										// 'related_id' =>22
										]);	

										Flashpoint::insert(
											[
											'flash_points' 		=> $deletedRightCarry,
											'user_id'		  	=> $matches->user_id,  
											'flash_position' 	=> 'R',  
											'date'		  		=> Carbon::now()
											]	
										);

										// return redirect()->back()->with('message', 'Step referral comission generated successfully');

									}
								else
									{
										return "No matching are available";
									}

							}
					}
			}

			return redirect()->back()
							 ->with('message', 'Step referral comission generated successfully')
							 ->with('message1', "Total Amount USD: ".$totalAmount)
							 ->with('message2', "Step referral comission generated for ".$totalSrcUser." users");

		
		

	}

	/**
	* checkLavel. Call within generateReferralPoints() function
	* make compare and taken nearest of highest value
	*
	* @return integer
	*/

	public function checkLavel ($lavels, $carry )
	{	
		
		arsort($lavels); // sort the lavels in reverse so we can pass any array and the highest number will be the first because we are looking for a number lower or equal to our point
		foreach ( $lavels as $lavel )
		{
			
			if ( $lavel <= $carry ){
			
				return $lavel;
			}
		}
	}


}
