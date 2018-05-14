<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Socialite;
use Session;

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
    // Service Providers i.e G+, FB, TWITTER
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }
    public function handleProviderCallback($service)
    {
      if($service == 'twitter'){
        $user = Socialite::driver($service)->user();
      }else{
        $user = Socialite::driver($service)->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->stateless()->user();
      }
      $findVerifiedUser = User::where(['email'=> $user->getEmail(), 'status' => 1])->first();
      $findNotVerifiedUser = User::where(['email'=> $user->getEmail(), 'status' => 0])->first();
      if($findVerifiedUser){
        Auth::login($findVerifiedUser);
      }elseif($findNotVerifiedUser){
        Session::flash('message','Your email is now verified because of social login!');
        User::where(['email'=> $user->getEmail(), 'status' => 0])->update(['status' => 1 , 'verifyToken' => NULL]);
        Auth::login($findNotVerifiedUser);
      }else{
        $newUser = new User;
        $newUser->email = $user->getEmail();
        $newUser->name = $user->getName();
        $newUser->password = bcrypt( str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT) );
        $newUser->status = 1;
        $newUser->verifyToken = NULL;
        $newUser->save();
        Auth::login($newUser);
      }
      return redirect('home/edit-profile');
    }
    // Validation for status i.e if status is 1, then user can login
    protected function credentials(Request $request)
    {
      return ['email' => $request->{$this->username()},'password' => $request->password, 'status'=>1];
    }

}
