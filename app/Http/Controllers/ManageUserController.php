<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UplineChangeRequest;

use App\Ccrequest;
use App\User;
use App\Downline;
use App\Carry;
use Auth;
use Carbon\Carbon;


class ManageUserController extends Controller
{
    
    public function getUserRequest()
    {
    	$ccRequests = Ccrequest::where('status', 0)->get();

		$ccRequestsPhone = Ccrequest::where('phone', '!=', '')
    							 ->where('req_phone', '!=', '')
    							 ->where('status', 0)->get();    							 

    	return view('ccrequest.requests',compact('ccRequests'));

    }


    public function update($id)
    {
    	
    	// return $id;
    	$info = Ccrequest::where('id', $id)->first();
    	$userInfo = User::where('id', $info->user_id)->first();

    	if($info->email != null)
    	{
    		User::where('id', $info->user_id)->update([
    			'email' => $info->req_email
    			]);
    		Ccrequest::where('id', $id)->update(['status'=>1]);

    		$to = $info->email;
            $to2 = $info->req_email;
    		$email_header= 'FBO Corporation <no-reply@fbofund.com>';
    		$sub = "Email address confirmation";
    		$message = "This message is to notify you that the email associated to your FBOC account <b>" .$userInfo->username. "</b>is being changed. <b> ".$info->email ." </b> is being changed to <b> ".$info->req_email ."</b> <br/><br/><br/><br/>If you did not initialize the email change procedure, please contact FBOC member support immediately.<br/><br/>***************************************************************************************************************<br/><br/>This is an automated email - Please do not reply.<br/>This mailbox is not monitored and you will not receive a response.<br/>To contact us, login to your FBOC account and send us a message via Support Ticket.<br/>***************************************************************************************************************";
    		$headers = "From: $email_header\r\n";
    		$headers .= "Content-type: text/html\r\n";

    		mail($to, $sub, $message, $headers);
            mail($to2, $sub, $message, $headers);


    		return redirect()->back()->with('smessage','Successfully email address updated.');
    	}
    	else
    	{
    		// return $info->user_id;

    		User::where('id', $info->user_id)->update([
    			'phone_number' => $info->req_phone
    			]);
    		Ccrequest::where('id', $id)->update(['status'=>1]);

    		return redirect()->back()->with('smessage','Successfully phone number updated.');
    	}

    }


    public function uplineChange()
    {
        return view('admin.uplinechange.uplinechange');
    }

    public function uplineChangeRequest(UplineChangeRequest $request)
    {
       // return $request->all();

       $carry = $request->carry; //flashcarries
       $suser = $request->suser;
       $eupline = $request->eupline;
       $nupline = $request->nupline;
       $position = $request->position;

       $userInfo = User::where('username', $suser)->first();

       if($userInfo == null)
       {
          return redirect()->back()->with('message', 'User not found');
       }

        if(  $carry === 'flashcarries')
        {
            // return "Flash Carries";
            // return $userInfo;
            Carry::where('user_id', $userInfo->id)->update(['left_carry'=>0, 'right_carry'=>0]);
            $newUplineID = User::where('username', $nupline)->first()->id;
            $exUplineId  = User::where('username', $eupline)->first()->id;
            User::where('id', $userInfo->id)->update(['upline_id'=>$newUplineID]);
            
            if($position=='Left')
            {
                
                $downline = Downline::where('user_id',$exUplineId)->first();
                if( $downline->left_member_id == $userInfo->id )
                {
                    Downline::where('user_id',$downline->user_id)->update(['left_member_id'=>0]);
                }
                else
                {
                    Downline::where('user_id',$downline->user_id)->update(['right_member_id'=>0]);
                }

                Downline::where('user_id', $newUplineID)->update(['left_member_id'=>$userInfo->id]);

                return redirect()->back()->with('smessage','Successfully changed upline ID.');
            
            }

            if($position=='Right')
            {
                
                $downline = Downline::where('user_id',$exUplineId)->first();
                if( $downline->right_member_id == $userInfo->id )
                {
                    Downline::where('user_id',$downline->user_id)->update(['left_member_id'=>0]);
                }
                else
                {
                    Downline::where('user_id',$downline->user_id)->update(['right_member_id'=>0]);
                }

                Downline::where('user_id', $newUplineID)->update(['right_member_id'=>$userInfo->id]);

                return redirect()->back()->with('smessage','Successfully changed upline ID.');
            
            }

           

        }
        else
        {
            // return "With Carries";
            // return $userInfo;
            $newUplineID = User::where('username', $nupline)->first()->id;
            $exUplineId  = User::where('username', $eupline)->first()->id;
            User::where('id', $userInfo->id)->update(['upline_id'=>$newUplineID]);
            
            if($position=='Left')
            {
                
                $downline = Downline::where('user_id',$exUplineId)->first();
                if( $downline->left_member_id == $userInfo->id )
                {
                    Downline::where('user_id',$downline->user_id)->update(['left_member_id'=>0]);
                }
                else
                {
                    Downline::where('user_id',$downline->user_id)->update(['right_member_id'=>0]);
                }

                Downline::where('user_id', $newUplineID)->update(['left_member_id'=>$userInfo->id]);

                return redirect()->back()->with('smessage','Successfully changed upline ID.');
            
            }

            if($position=='Right')
            {
                
                $downline = Downline::where('user_id',$exUplineId)->first();
                // return $userInfo->id;
                if( $downline->left_member_id == $userInfo->id )
                {
                    Downline::where('user_id',$downline->user_id)->update(['left_member_id'=>0]);
                }
                else
                {
                    Downline::where('user_id',$downline->user_id)->update(['right_member_id'=>0]);
                }

                Downline::where('user_id', $newUplineID)->update(['right_member_id'=>$userInfo->id]);

                return redirect()->back()->with('smessage','Successfully changed upline ID.');
            
            }

           

        }
    }



// ajax funciton
    public function ajaxSearchUser($suser)
    {
        $userInfo = User::where('username', $suser)->first();

        

        $userInfos=[];

        if($userInfo==null)
        {
            echo json_encode("User not found");
        }
        else
        {
            $upUname= User::where('id', $userInfo->upline_id)->first()->username;

            array_push($userInfos,$userInfo->username);
            array_push($userInfos,$upUname);

            echo json_encode($userInfos);
        
        }
       
    }


    public function ajaxCheckNewUpline($nupline)
    {
        $check = User::where('username', $nupline)->first();

        // echo json_encode($check);
        // return;
        if( $check == null)
        {
            echo json_encode('User not found');
        }
        else
        {
            $position = Downline::where('user_id', $check->id)->first();

            if($position->left_member_id != 0 && $position->right_member_id != 0)
            {
                echo json_encode('Cannot move to this user upline.');
            }
            else if($position->left_member_id == 0 && $position->right_member_id != 0)
            {
                echo json_encode('Left');
            }
            else if($position->left_member_id != 0 && $position->right_member_id == 0)
            {
                echo json_encode('Right');
            }
            else
            {
                echo json_encode('Left');
            }
         
        }
    }
}
