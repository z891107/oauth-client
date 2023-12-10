<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('oauth')->redirect();
});

Route::get('/auth/callback', function () {
    // $user = Socialite::driver('oauth')->user();
    $user = Socialite::driver('oauth')->stateless()->user();

    dd($user);

    // try {
    //     $cognitoUser = Socialite::driver('oauth')->user();
    //     $user = User::query()->whereEmail($cognitoUser->email)->first();

    //     if (!$user) {
    //         return redirect('login');
    //     }

    //     Auth::guard('web')->login($user);

    //     return redirect(route('home'));
    // } catch (Exception $exception) {
    //     return redirect('login');
    // }
});
