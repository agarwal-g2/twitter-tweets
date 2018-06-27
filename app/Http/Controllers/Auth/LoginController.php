<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
        * Handle Facebook login request
        *
        * @return response
     */

    public function socialLogin(){
        return Socialite::driver('facebook')->redirect();
    }

    /**

        * Obtain the user information from Social Logged in.

        * @param $social

        * @return Response

        */

    public function handleProviderCallback(){
        $userSocial = Socialite::driver('facebook')->user();
        //redirect to the hashtag search page
        return redirect()->action('TwitterController@index');
    }
}
