<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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
    protected function _registerOrLoginUser($data){
    $user = User::where('email',$data->email)->first();
      if(!$user){
         $user = new User();
         $user->name = $data->name;
         $user->email = $data->email;
         $user->provider_id = $data->id;
         $user->avatar = $data->avatar;
         $user->save();
      }
    Auth::login($user);
    }

        //Google Login
    public function redirectToGoogle(){
    return Socialite::driver('google')->stateless()->redirect();
    }

    //Google callback  
    public function handleGoogleCallback(){

    $user = Socialite::driver('google')->stateless()->user();

      $this->_registerorLoginUser($user);
      return redirect()->route('home');
    }

    //Facebook Login
    public function redirectToFacebook(){
    return Socialite::driver('facebook')->stateless()->redirect();
    }

    //facebook callback  
    public function handleFacebookCallback(){

    $user = Socialite::driver('facebook')->stateless()->user();

      $this->_registerorLoginUser($user);
      return redirect()->route('home');
    }

    //Github Login
    public function redirectToGithub(){
    return Socialite::driver('github')->stateless()->redirect();
    }

    //github callback  
    public function handleGithubCallback(){

    $user = Socialite::driver('github')->stateless()->user();

      $this->_registerorLoginUser($user);
      return redirect()->route('home');
    }

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
}
