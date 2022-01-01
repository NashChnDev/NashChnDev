<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Users;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/employees';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function credentials(Request $request)
    {
       // dd($this->username());
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'name';//supports username or email
        return [
            $field => $request->get($this->username()),
            'password' => $request->password
        ];
    }
    
    
    public function login(Request $request)
    {
            
       
          
            
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
            

        $users = \DB::table('users')->where('name', $request->email)->first();

        if (auth()->guard('web')->attempt(['name' => $request->email, 'password' => $request->password])) {

            $new_sessid   = \Session::getId(); //get new session_id after user sign in

            
            if($users->session_id != '') 
            {
                $last_session = \Session::getHandler()->read($users->session_id); 
                
                //dd($new_sessid);

                if ($last_session) {
                    if (\Session::getHandler()->destroy($users->session_id)) {
                        
                    }
                }
            }

            \DB::table('users')->where('id', $users->id)->update(['session_id' => $new_sessid]);
            
            $users = auth()->guard('web')->user();
          //dd($user);
            
            return redirect($this->redirectTo);
        } 
            
           
        \Session::put('login_error', 'Your email and password wrong!!');
        return back();

    }
    
    
    /*
        public function login(Request $request)
    {
            
   
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
            

        $user = \DB::table('users')->where('name', $request->email)->first();
         
        if (auth()->guard('web')->attempt(['name' => $request->email, 'password' => $request->password])) {

            $new_sessid   = \Session::getId(); //get new session_id after user sign in

            if($user->session_id != '') 
            {
                $last_session = \Session::getHandler()->read($user->session_id); 
                
                if ($last_session) {
                    if (\Session::getHandler()->destroy($user->session_id)) {
                        
                    }
                }
            }

            \DB::table('users')->where('id', $user->id)->update(['session_id' => $new_sessid]);
            
            
            
           /* if($user->is_logged_in == 0)
            {
                $user = auth()->guard('web')->user();
                auth()->user()->update(['is_logged_in' => 1,'lastloggedip'=>$request->ip()]);
                return redirect($this->redirectTo);
            }
            else
            {
                auth()->logout();
                return redirect('login')->withErrors(['unexpected_error' => 'Already Logged in Another Browser '.$user->lastloggedip]);
            }
            
            
        } 
            
           
        \Session::put('login_error', 'Your email and password wrong!!');
        return back();

    }*/
    
    public function logout()
{
        
   // auth()->user()->update(['is_logged_in' => 0]);

    auth()->logout();

    return redirect('login');
}
    
    
    /* protected function authenticated(Request $request, $user)
    {

        if(Gate::allows('is_super_user_staff'))
        {
            return redirect()->intended(route('dashboard.index'));
        }
        else if(Gate::allows('is_cha'))
        {
            Auth::logoutOtherDevices($request->get('password'));
            $valid_subscription=$user->account->subscription->where('subscription_date','<=',Carbon::now()->format('Y-m-d'))->where('valid_till','>=',Carbon::now()->format('Y-m-d'))->first();
            if($valid_subscription!=null)
                return redirect()->intended(route('dashboard.index'));
           
        }
        
    }*/
}
