<?php

use App\Actions\sms_api\ippanel\ippanel_connector;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\checkLogin;
use App\Http\Middleware\checkMobileVerify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware([checkLogin::class, checkMobileVerify::class]);
});

Route::get('/credit', function () {
    return (new ippanel_connector())->getCredits();
});

//if (Auth::user()) {
Route::controller(AuthController::class)->group(function () {
    Route::get('/verify', function () {
        return view('verify');
    })->name('verify')->middleware(checkLogin::class);

    Route::get('/verify-otp', function () {
        return view('verify_otp');
    })->name('verifyOTP')->middleware(checkLogin::class);

    Route::post('/send-otp', 'sendOTP')->name('sendOTP');
    Route::post('/validate-otp', 'verifyOTPAndLogin')->name('checkOTP');
});
//}else{
//Route::get('/verify', function () {
//return redirect('/login')->with('error', 'Please login to verify your account.');
//});

//Route::get('/verify-otp', function () {
return redirect('login')->with('error', 'Please login to verify your account.');
//});
//}
