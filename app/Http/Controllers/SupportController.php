<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Support;
use App\User;
use Auth;

use App\Http\Requests\SupportRequest;
use Carbon\Carbon;

class SupportController extends Controller
{
    public function postSupport(SupportRequest $request)
    {
    	// return $request->all();
    	Support::insert([
    		'subject'			=> $request->subject,
    		'problem_details'	=> $request->problem_details,
    		'user_id'			=> Auth::id(),
    		'request_date'		=> Carbon::now(),
    		// 'response_date' 	=> 
    		// 'status'
    		]);

    	return redirect()->back()->with('smessage', 'Sucessfully Submitted Your Query');
    }

    public function viewSupport($slug)
    {

        $support = Support::where('subject', $slug)->first();
        return view('support.support', compact('support'));
    }


    public function responseSupport(Request $request)
    {
        // return $request->editor1;

        Support::where('id', $request->id)->update([
            'response' => $request->editor1,
            'response_date'=> Carbon::now(),
            'status' => 1  
            ]);

        return redirect()->back();

    }

    public function viewNotification($slug)
    {
        

        $supports = Support::where('user_id', Auth::id())
                                  ->where('status',1)->get();

                   Support::where('id', $slug)->update(['status' => 2]);
                                  
        $notification = Support::where('id', $slug)
                                 ->where('status',2)->first();

        // return $notification->response;                                 

        return view('support.notification', compact('supports', 'notification'));
    }


    public function allNotification(){
        $allNots = Support::where('user_id', Auth::id())->get();

         $supports = Support::where('user_id', Auth::id())
                                  ->where('status',1)->get();
                                  
        

        return view('support.allnot', compact('supports','allNots'));
    }

    public function notView($id)
    {
         $supports = Support::where('user_id', Auth::id())
                                  ->where('status',1)->get();
         $notView = Support::where('id', $id)->first();

         return view('support.allnot', compact('supports','notView'));

    }
}
