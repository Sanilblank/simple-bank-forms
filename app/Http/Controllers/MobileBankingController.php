<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobileBankingRequest;
use App\Models\Customer;
use App\Models\MobileBanking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MobileBankingController extends Controller
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
            if ($customer->mobileBanking) {
                return redirect()->back()->with('error', 'Mobile Banking already exists.');
            }

            $statuses = ['Active', 'Inactive'];

            return view('mobile-banking.create', compact('customer', 'statuses'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MobileBankingRequest $request, Customer $customer): View|RedirectResponse
    {
        try {
            MobileBanking::create([
                'customer_id' => $customer->customer_id,
                'registered_number' => $request->registered_number,
                'status' => $request->status,
            ]);

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Mobile Banking created successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MobileBanking $mobileBanking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, MobileBanking $mobileBanking): View|RedirectResponse
    {
        try {
            $statuses = ['Active', 'Inactive'];

            return view('mobile-banking.edit', compact('customer', 'mobileBanking', 'statuses'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer, MobileBanking $mobileBanking): RedirectResponse
    {
        try {
            $mobileBanking->update([
                'registered_number' => $request->registered_number,
                'status' => $request->status,
            ]);

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Mobile Banking updated successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, MobileBanking $mobileBanking): RedirectResponse
    {
        try {
            $mobileBanking->delete();

            return redirect()->route('customers.show', $customer->customer_id)->with('success',
                'Mobile Banking deleted successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
