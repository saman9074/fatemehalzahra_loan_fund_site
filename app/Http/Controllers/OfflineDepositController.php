<?php

namespace App\Http\Controllers;

use App\Models\OfflineDeposit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfflineDepositController extends Controller
{
    //
    /**
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'origin_card_number' => 'required',
            'destination_card_number' => 'required',
            'amount' => 'required',
            'deposit_time' => 'required',
            'tracking_number' => 'required',
        ]);

        OfflineDeposit::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'offline deposit request created.');
    }

    public function offline_deposit()
    {
        return view('bank/offlineDeposit');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function offline_deposit_list(){
        $offlineDeposits = OfflineDeposit::all();
        return view('bank/offlineDepositList', compact('offlineDeposits'));
    }
}
