<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Crypt;

use Auth;
use App\User;
use App\Downline;
use App\Carry;

class ReferralController extends Controller
{
   
      public $treeString = '';
      public $treeData = [];
      public $rightIdList = [];
      public $leftIdList = [];


  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('timeout');
  }

   public function index($slug)
   {

    // $uid = User::where('username', $slug)->first()->id;

    //user block start

    $nameFind = User::where('username', $slug)->first();
    
    $ids = $this->searchBlock(Auth::id());

    array_push($ids, Auth::id());


    $person = in_array($nameFind->id, $ids);

    $blankName = $nameFind->username;
    $cryptedName = $nameFind->username;
    $newValue = [$blankName, $cryptedName];

    
    if($person == true)
    {
      $uid = User::where('username', $slug)->first()->id;
      // return "true";

    }
    else{
       // $uid = User::where('username', $slug)->first()->id;
      return redirect()->back()->with('message','User not found in your downline list');
    }

    //user block end
   

    $topUserInfo = $this->getTopUser($uid);
    $child1 = $this->getChild($this->getDownLineLeft($topUserInfo['id']));
    $child2 = $this->getChild($this->getDownLineRight($topUserInfo['id']));
    
    $child3 = $this->getChild($this->getDownLineLeft($child1['id']));
    $child4 = $this->getChild($this->getDownLineRight($child1['id']));

    $child5 = $this->getChild($this->getDownLineLeft($child2['id']));
    $child6 = $this->getChild($this->getDownLineRight($child2['id']));

         

    return view('accounts.referralTree', compact('topUserInfo','child1','child2','child3','child4','child5','child6'));

   }  //Index End




   public function getTopUser($uid)
   {
      $topUserInfo = User::where('id', $uid)->first();
      return $topUserInfo;
   }

   public function getChild($uid)
   {
        $childInfo = User::where('id', $uid)->first();
        return $childInfo;
   }

public function getDownLineLeft($uid)
   {
        $downLineLeft = Downline::where('user_id', $uid)->first();
        return $downLineLeft['left_member_id'];        
   }

public function getDownLineRight($uid)
   {
        $downLineRight = Downline::where('user_id', $uid)->first();
        return $downLineRight['right_member_id'];        
   }


  


  
   
//genealogy end

   public function mouseOverTable($uid)
   {
    return $uid;
   }




   





  // Ajax method for searching user name on user table
     public function searchName($name){


      

      $nameFind = User::where('username', $name)->first();
      
      $ids = $this->searchBlock(Auth::id());



      // echo json_encode($ids);return;

      $person = in_array($nameFind->id, $ids);

      $blankName = $nameFind->username;
      $cryptedName = $nameFind->username;
      $newValue = [$blankName, $cryptedName];

      // echo json_encode($u->id);
      if($person == true)
      {
        echo json_encode($newValue);
      }
      else{
        echo json_encode("User not found in your downline list");
      }

     
     }

     public function searchBlock($uid)
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
          $this->searchBlock($downTable->left_member_id);
        }
        if($downTable->right_member_id !=0){
          $this->searchBlock($downTable->right_member_id);
        }

        return array_merge($this->leftIdList, $this->rightIdList);

        }



     }

  // Ajax method for searching user name on user table end







  
}
