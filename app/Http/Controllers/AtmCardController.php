<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtmCardRequest;
use App\Models\AtmCard;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AtmCardController extends Controller
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

            return view('atm-cards.create', compact('customer'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AtmCardRequest $request, Customer $customer): RedirectResponse
    {
        try {
            AtmCard::create([
                'customer_id' => $customer->customer_id,
                'account_id' => $request->account_id,
                'card_number' => $request->card_number,
                'expiry_date' => $request->expiry_date,
            ]);

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Atm card created successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AtmCard $atmCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, AtmCard $atmCard): View|RedirectResponse
    {
        try {
            $customer->load('accounts');

            return view('atm-cards.edit', compact('customer', 'atmCard'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtmCardRequest $request, Customer $customer, AtmCard $atmCard): RedirectResponse
    {
        try {
            $atmCard->update([
                'account_id' => $request->account_id,
                'expiry_date' => $request->expiry_date,
            ]);

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Atm card updated successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, AtmCard $atmCard): RedirectResponse
    {
        try {
            $atmCard->delete();

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Atm card deleted successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
