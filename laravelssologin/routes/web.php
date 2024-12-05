<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return Socialite::driver('keycloak')->redirect();
})->name('login');

// Route::get('/callback', function () {
//     $user = Socialite::driver('keycloak')->user();

//     // Xử lý thông tin user từ Keycloak
//     dd($user);
// });

Route::get('/callback', function () {
    $keycloakUser = Socialite::driver('keycloak')->user();

    // Tìm user trong database hoặc tạo mới
    $user = User::firstOrCreate([
        'email' => $keycloakUser->getEmail(),
    ], [
        'name' => $keycloakUser->getName(),
        'password' => bcrypt(Str::random(16)), // Mật khẩu ngẫu nhiên
    ]);

    // Đăng nhập user
    Auth::login($user);

    return redirect('/home');
});

