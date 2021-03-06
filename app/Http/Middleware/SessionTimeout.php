<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;
use App\User;

class SessionTimeout
{
    
    protected $session;
    protected $timeout = 900;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }



    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
       if(!$this->session->has('lastActivityTime'))
                   $this->session->put('lastActivityTime',time());
               elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
                   $this->session->forget('lastActivityTime');
                   

                   User::where('id', Auth::user()->id)
                    ->update(['is_logged'=> 0]);

                    Auth::logout();

                   return redirect('auth/login')->with(['warning' => 'You did not have any activity for last '.$this->timeout/60 .' minutes.']);
               }
               $this->session->put('lastActivityTime',time());
               return $next($request);
    }
}
