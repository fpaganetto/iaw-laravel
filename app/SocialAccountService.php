<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use Illuminate\Support\Facades\Hash;

class SocialAccountService{

    public static function findOrCreateUser(ProviderUser $user, $provider){
        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => bcrypt($user->token),
            /*'provider' => $provider,
            'provider_id' => $user->id*/
        ]);
    }
}