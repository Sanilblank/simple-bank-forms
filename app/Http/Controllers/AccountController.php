<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\AccountCategory;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Customer $customer): View|RedirectResponse
    {
        try {
            $branches = Branch::all();
            $accountCategories = AccountCategory::all();

            return view('accounts.create', compact('customer', 'branches', 'accountCategories'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $request, Customer $customer): RedirectResponse
    {
        try {
            Account::create([
                'account_id' => $request->account_id,
                'customer_id' => $customer->customer_id,
                'branch_id' => $request->branch_id,
                'account_category_id' => $request->account_category_id,
                'balance' => $request->balance,
                'date_opened' => now(),
            ]);

            return redirect()->route('customers.show', $customer->customer_id)->with('success', 'Account created successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer, Account $account): View|RedirectResponse
    {
        try {
            $account->load(['branch', 'category']);

            return view('accounts.show', compact('account', 'customer', 'account'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, Account $account): View|RedirectResponse
    {
        try {
            $branches = Branch::all();
            $accountCategories = AccountCategory::all();

            return view('accounts.edit', compact('customer', 'branches', 'accountCategories', 'account'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, Customer $customer, Account $account): RedirectResponse
    {
        try {
            $account->update([
                'branch_id' => $request->branch_id,
                'account_category_id' => $request->account_category_id,
                'balance' => $request->balance,
            ]);

            return redirect()->route('customers.show', $customer->customer_id)->with('success', 'Account updated successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, Account $account): RedirectResponse
    {
        try {
            $account->delete();

            return redirect()->route('customers.show', $customer->customer_id)->with('success', 'Account deleted successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
