<?php

use App\Actions\sms_api\ippanel\ippanel_connector;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Middleware\checkLogin;
use App\Http\Middleware\checkMobileVerified;
use App\Http\Middleware\checkMobileVerify;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('/verify', function () {
        return view('verify');
    })->name('verify')->middleware([checkLogin::class, checkMobileVerified::class]);

    Route::get('/verify-otp', function () {
        return view('verify_otp');
    })->name('verifyOTP')->middleware([checkLogin::class, checkMobileVerified::class]);

    Route::post('/send-otp', 'sendOTP')->name('sendOTP');
    Route::post('/validate-otp', 'verifyOTPAndLogin')->name('checkOTP');
});

Route::controller(BankAccountController::class)->group(function () {

    Route::get('/bank-accounts/create', 'create')->name('bank-accounts.create');

    Route::post('/bank-accounts/create/store', 'store')->name('bank-accounts.store');

});

Route::controller(FinancialTransactionController::class)->group(function () {
    Route::get('/bank-accounts/offline-deposit', 'offline_deposit')->name('bank-accounts.offline-deposit');
    Route::post('/bank-accounts/offline-deposit/store', 'store')->name('offline-deposit.store');

    Route::get('/bank-accounts/internal-transfer', 'internal_transfer')->name('bank-accounts.internal-transfer');
    Route::post('/bank-accounts/internal-transfer/store', 'store')->name('internal-transfer.store');
});
