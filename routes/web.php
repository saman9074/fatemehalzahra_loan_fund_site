<?php

use App\Actions\sms_api\ippanel\ippanel_connector;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\LoanRequestsController;
use App\Http\Controllers\OfflineDepositController;
use App\Http\Middleware\checkLogin;
use App\Http\Middleware\checkMobileVerified;
use App\Http\Middleware\checkMobileVerify;
use Illuminate\Support\Facades\Route;

//show landing page
Route::get('/', function () {
    return view('welcome');
});

//jeststream dashboard show
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware([checkLogin::class, checkMobileVerify::class]);
});

//test for sms panel
Route::get('/credit', function () {
    return (new ippanel_connector())->getCredits();
});

//verify mobile number
Route::controller(AuthController::class)->group(function () {
    //show verify send sms page
    Route::get('/verify', function () {
        return view('verify');
    })->name('verify')->middleware([checkLogin::class, checkMobileVerified::class]);

    //show verify enter OTP
    Route::get('/verify-otp', function () {
        return view('verify_otp');
    })->name('verifyOTP')->middleware([checkLogin::class, checkMobileVerified::class]);

    //send sms
    Route::post('/send-otp', 'sendOTP')->name('sendOTP');
    //check OTP
    Route::post('/validate-otp', 'verifyOTPAndLogin')->name('checkOTP');
});


//open bank account
Route::controller(BankAccountController::class)->group(function () {
    //show open account form
    Route::get('/bank-accounts/create', 'create')->name('bank-accounts.create');
    //open account and save to DB
    Route::post('/bank-accounts/create/store', 'store')->name('bank-accounts.store');

});


//Transaction management
Route::controller(FinancialTransactionController::class)->group(function () {
    //save transaction to db
    //Route::post('/bank-accounts/offline-deposit/store', 'store')->name('offline-deposit.store');

    //show internal transfer form
    Route::get('/bank-accounts/internal-transfer', 'internal_transfer')->name('bank-accounts.internal-transfer');
    //save transaction for internal transfer
    Route::post('/bank-accounts/internal-transfer/store', 'store')->name('internal-transfer.store');
});

Route::controller(OfflineDepositController::class)->group(function () {
    //save offline deposit request to db
    Route::post('/bank-accounts/offline-deposit/store', 'store')->name('offline-deposit.store');

    //show create request for offline deposit form
    Route::get('/bank-accounts/offline-deposit', 'offline_deposit')->name('bank-accounts.offline-deposit');

    Route::get('/bank-accounts/offline-deposit-list', 'offline_deposit_list')->name('bank-accounts.offline-deposit-list');
});

Route::controller(LoanRequestsController::class)->group(function () {
    Route::get('/loan-requests/create', 'loanRequestForm')->name('loan-requests.create');
    Route::post('/loan-requests/create/store', 'store')->name('loan-requests.store');
    Route::get('/loan-requests/list', 'loan_requests_list')->name('loan-requests.list');
});
