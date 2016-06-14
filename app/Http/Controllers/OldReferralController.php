<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Auth;
use App\User;
use App\Downline;
use App\Carry;

class ReferralController extends Controller
{
   
	    public $chain = [];
      public $tree_string = "";
      public $leftCount = 0;
      public $rightCount = 0; 
      public $tableString = "";

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('timeout');
	}

   public function index($slug)
   {
   	
    $id = User::where('username', $slug)->first()->id;


    // return $this->mouseOverTable($id);

   	$this->genealogy( $id, 0, 0);
   	$var = $this->tree_string;
    $table = $this->tableString;
   	return view('accounts.referralTree', compact('var'));
   }

   
   public function genealogy($uid, $startingPoint, $flag)
   
   {

   	$startingPoint++;
      // echo $flag;

   	if ( $startingPoint != 3 )
   	{
   		$checkDownline = Downline::where( 'user_id', $uid )->first();

   		if( $startingPoint == 1 )
   		{
   			 // check status start
            
         
            if(User::where('id',$uid)->first()->status == 1)
            {
              // $this->mouseOverTable($uid);
              $this->tree_string .= '<div class="re-active"><a href="">';
              $this->tree_string .= User::where('id',$uid)->first()->username;
              // $this->tree_string .= '<input type="hidden" id="'.User::where('id', $uid)->first()->id.'" value="'.User::where('id',$uid)->first()->username.'"/>';
              $this->tree_string .= '</a></div><div></div><div></div>';
              

            }
            else
            {
              $this->tree_string .= '<div class="re-inactive"><a href="">';

              $this->tree_string .= User::where('id',$uid)->first()->username;

              $this->tree_string .= '</a></div><div></div><div></div>';
              // $this->mouseOverTable($uid);
            }

         // check status end
   		}
      // return;

   		if( $checkDownline && $checkDownline->left_member_id != 0 )
   		{

   			if($flag == 0)
   			{
   				     $this->tree_string .= '<div></div><div></div>';
               
               $this->tree_string .= '<div></div><div></div>';
   			}

            // check status start

         			if(User::where('id', $checkDownline->left_member_id)->first()->status == 1)
              {
                $this->tree_string .= '<div class="re-active"><a href="'.User::where('id', $checkDownline->left_member_id)->first()->username.'">';

                $this->tree_string .= User::where('id', $checkDownline->left_member_id)->first()->username;
                  // $this->tree_string .= "flag = ". $flag;
                $this->tree_string .= '</a></div>';
                // $this->mouseOverTable($checkDownline->left_member_id);
                
              }
              else
              {
                $this->tree_string .= '<div class="re-inactive"><a href="'.User::where('id', $checkDownline->left_member_id)->first()->username.'">';

                $this->tree_string .= User::where('id', $checkDownline->left_member_id)->first()->username;
                  // $this->tree_string .= "flag = ". $flag;
                $this->tree_string .= '</a></div>';
                // $this->mouseOverTable($checkDownline->left_member_id);
              }

             // check status end    
        

   		}
   		else
   			{
   				 $this->tree_string .= '<div class="re-blank"><a href="">Blank</a></div>';
   			}

   		if( $checkDownline && $checkDownline->right_member_id != 0) 
   		{

   			 if(User::where('id', $checkDownline->right_member_id)->first()->status == 1)
         {
          $this->tree_string .= '<div class="re-active"><a href="'.User::where('id', $checkDownline->right_member_id)->first()->username.'">';
          
          // $this->mouseOverTable($checkDownline->right_member_id);
          $this->tree_string .= User::where('id', $checkDownline->right_member_id)->first()->username;
          $this->tree_string .= '</a>';
          $this->tree_string .= '<span class="box">'.$this->tableString;
          $this->tree_string .= '</span></div>';
          

         }
         else
         {
          $this->tree_string .= '<div class="re-inactive"><a href="'.User::where('id', $checkDownline->right_member_id)->first()->username.'">';
          
          $this->tree_string .= User::where('id', $checkDownline->right_member_id)->first()->username;
          $this->tree_string .= '</a>';
          $this->tree_string .= '<span class="box">'.$this->tableString;
          $this->tree_string .= '</span></div>';
          // $this->mouseOverTable($checkDownline->right_member_id);
         }
         
   		}
   		else
   		{
   			 $this->tree_string .= '<div class="re-blank"><a href=""> Blank </a></div>';
   		}

      // return $flag;
   		if( $flag == 0 )
         {
            // $this->tree_string .= '<div></div><div></div>';
               
            // $this->tree_string .= '<div></div><div></div>';
         }


   		if( $checkDownline && $checkDownline->left_member_id < 0  && $checkDownline->right_member_id < 0)
   		
   		{
   			if($checkDownline->left_member_id==0 && $checkDownline->right_member_id == 0){
          return;
        }
        $this->genealogy($checkDownline->left_member_id, $startingPoint, 2);
   		}
   		
   		else
   		
   		{
   			$this->genealogy(0, $startingPoint, 1);
   		}


   		if( $checkDownline && $checkDownline->left_member_id != 0 && $checkDownline->right_member_id != 0 )
   		
   		{  
   			$this->genealogy($checkDownline->right_member_id, $startingPoint, 2);
   		}
   		
   		else
   		
   		{
   			$this->genealogy(0, $startingPoint, 1);
   		}
   	}

   }


// Ajax method for searching user name on user table
   public function searchName($name){

    $nameFind = User::where('username', 'LIKE', "$name%")->get();

    if(is_null($nameFind)){
      echo json_encode("User not found");
    }
    else
    {
      echo json_encode($nameFind);  
    }
    
   }


 

  public function mouseOverTable($uid)
  {
    if($uid >0){
        $userInfo = User::where('id',$uid)->first();
        $carryInfo = Carry::where('id',$uid)->first();

       $this->countMembers($uid);
       // return $this->leftCount."+++++". $this->rightCount;

       $this->tableString .= '<table border="1"><tr><td colspan="3">';
       $this->tableString .= $userInfo->full_name;
       $this->tableString .= '</td></tr>';
       
       $this->tableString .= '<tr><td colspan="3">';
       $this->tableString .= User::where('id', $userInfo->referrar_id)->first()->username;
       $this->tableString .= '</td></tr>';

       $this->tableString .= '<tr><td colspan="3">';
       $this->tableString .= User::where('id', $userInfo->upline_id)->first()->username;
       $this->tableString .= '</td></tr>';

       $this->tableString .= '<tr><th></th><th>Left Position</th><th>Right Position</th></tr>';
      
      $this->tableString .= '<tr><td>Members</td><td>';
      $this->tableString .= $this->leftCount;
      $this->tableString .= '</td><td>';
      $this->tableString .= $this->rightCount;
      $this->tableString .= '</td></tr>';

      $this->tableString .= '<tr><td>Members</td><td>';
      $this->tableString .= $carryInfo->left_carry;
      $this->tableString .= '</td><td>';
      $this->tableString .= $carryInfo->right_carry;
      $this->tableString .= '</td></tr>';  

      $date = strtotime($userInfo->signup_date);
      $this->tableString .= '<tr><td colspan="2">Joining Date</td><td>';
      $this->tableString .= date('Y-m-d',$date);
      $this->tableString .= '</td></tr>';
    }

  }  

 
 /**
 * countMembers from downline table 
 * Total Left memeber have requested user &
 * Total Right memeber have requested user
 * @return integer
 */



  public function countMembers($uid)
  {
    $downlineInfo = Downline::where('user_id', $uid)->first();
    
    if ( $downlineInfo->left_member_id == 0 ) {
    
      return false;
    }
    
    else
    {
      if ( $downlineInfo->left_member_id > 0){
           
           $this->leftCount++;
           
           $this->countMembers($downlineInfo->left_member_id);
      }
    }

    if ( $downlineInfo->right_member_id == 0 ) {
      
      return false;
    }

    else

    {
      
      if ( $downlineInfo->right_member_id > 0 ) {
     
           $this->rightCount++;
     
           $this->countMembers($downlineInfo->right_member_id);
     
      }
    }




  }

  
}
