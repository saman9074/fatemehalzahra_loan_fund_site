<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FinancialTransaction;
use App\Models\OfflineDeposit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FinancialTransactionController extends Controller
{
    //
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'amount' => 'required',
            'transaction_type' => 'required|in:deposit,withdrawal',
        ]);

        // ذخیره تراکنش مالی
        $financialTransaction = FinancialTransaction::create($validatedData);

        // پاسخ به کاربر
        return response()->json([
            'message' => 'تراکنش مالی با موفقیت ذخیره شد.',
            'transaction' => $financialTransaction,
        ], 201);
    }



    public function internal_transfer()
    {
        return view('bank/internalTransfer');
    }

}
