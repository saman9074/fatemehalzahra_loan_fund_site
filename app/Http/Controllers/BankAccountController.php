<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function create()
    {
        return view('bank/CreateBankAccount');
    }

    /**
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        BankAccount::create([
            'user_id' => Auth::user()->id,
            'account_number' => Auth::user()->mobile,
            'account_type' => $request->account_type,
            'account_creation_date' => now()->format('Y-m-d'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Bank Account Created Successfully');
    }
}
