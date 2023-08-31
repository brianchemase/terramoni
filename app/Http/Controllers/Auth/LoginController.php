<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
          Log::info(auth()->user()->role);
            if (auth()->user()->role == 'admin') 
            {
              return redirect()->route('admindash');
            }
            else if (auth()->user()->role == 'aggregator') 
            {
              return redirect()->route('aggregatordash');
            }
            else
            {
              return redirect()->route($this->getRedirectRoute());
              //return redirect()->route('agentsdash');
            }
        }
        else
        {
            return redirect()
            ->route('login')
            ->with('error','Incorrect email or password!.');
        }
    }

    public function getRedirectRoute()
    {
        //Log::info((int)$this->role);
        return match((int)auth()->user()->role) {
            9 => 'admindash',
            2 => 'teacher.dashboard',
            1 => 'admins',
        };
    }
}
