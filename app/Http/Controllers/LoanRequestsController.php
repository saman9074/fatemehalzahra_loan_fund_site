<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class LoanRequestsController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'income_variety' => 'required',
                'job_type' => 'required',
                'job_title' => 'required',
                'second_job' => 'required',
                'main_income' => 'required',
                'other_income' => 'required',
                'monthly_expenses' => 'required',
                'salary_slip' => 'required', 'mimes:jpg,jpeg,png,pdf', 'max:1024',
                'bank_statement' => 'nullable', 'mimes:pdf', 'max:1024',
                'assets' => 'required',
                'loan_amount' => 'required',
                'installments' => 'required',
                'reason' => 'required',
                'guarantor_name' => 'required',
                'guarantor_national_code' => 'required',
                'guarantor_birth_date' => 'required',
                'guarantor_has_check' => 'required',
            ]);

            // Save salary slip file
            $validatedData['salary_slip'] = $request->file('salary_slip')->store('public/files/salary');

            // Save bank statement file if exists
            if ($request->hasFile('bank_statement')) {
                $validatedData['bank_statement'] = $request->file('bank_statement')->store('public/files/files/bank_statement');
            }

            LoanRequest::create($validatedData);
        } catch (Throwable $ex) {
            return redirect()->route('dashboard')->with('success', $ex->getMessage());
        }

        return redirect()->route('dashboard')->with('success', 'Loan request created.');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function loanRequestForm()
    {
        return view('bank/loan-requests.create');
    }

    public function loan_requests_list(){
        $LoanRequests = LoanRequest::all();
        return view('bank.loan-requests.loanRequestLists', compact('LoanRequests'));
    }
}
