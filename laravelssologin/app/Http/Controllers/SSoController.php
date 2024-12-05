<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class SSoController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('keycloak')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('keycloak')->user();

        dump($user);
    }
}
