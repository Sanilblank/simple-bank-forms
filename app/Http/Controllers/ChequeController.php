<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChequeRequest;
use App\Models\Cheque;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChequeController extends Controller
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
            $customer->load('accounts');

            return view('cheques.create', compact('customer'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChequeRequest $request, Customer $customer): RedirectResponse
    {
        try {
            Cheque::create([
                'customer_id' => $customer->customer_id,
                'account_id' => $request->account_id,
                'date_issued' => $request->date_issued,
                'status' => 'Active',
            ]);

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Cheque created successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cheque $cheque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, Cheque $cheque): View|RedirectResponse
    {
        try {
            $customer->load('accounts');
            $statuses = ['Active', 'Finished', 'Cancelled'];

            return view('cheques.edit', compact('customer', 'cheque', 'statuses'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChequeRequest $request, Customer $customer, Cheque $cheque): RedirectResponse
    {
        try {
            $cheque->update([
                'date_issued' => $request->date_issued,
                'status' => $request->status,
            ]);

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Cheque updated successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, Cheque $cheque): RedirectResponse
    {
        try {
            $cheque->delete();

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Cheque deleted successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
