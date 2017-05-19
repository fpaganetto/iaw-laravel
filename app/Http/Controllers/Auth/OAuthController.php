<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use Auth;

class OAuthController extends Controller{
        /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function redirect($servicio){
        return Socialite::driver($servicio)->redirect();   
    }   
    
    public function callback($servicio){
        $user = Socialite::driver($servicio)->user();

        $authUser = SocialAccountService::findOrCreateUser($user, $servicio); //De SocialAccountService 
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }
}