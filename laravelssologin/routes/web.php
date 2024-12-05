<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return Socialite::driver('keycloak')->redirect();
});

Route::get('/callback', function () {
    $user = Socialite::driver('keycloak')->user();
    
    // Bạn có thể lưu thông tin người dùng vào cơ sở dữ liệu hoặc xử lý theo cách của mình
    dd($user);
});
