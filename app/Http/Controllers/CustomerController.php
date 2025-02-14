<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\CustomerIdentification;
use App\Models\IdentificationTypeEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|RedirectResponse
    {
        try {
            $customers = Customer::orderBy('updated_at', 'desc')->get();

            return view('customers.index', compact('customers'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|RedirectResponse
    {
        try {
            $identificationTypes = IdentificationTypeEnum::all();

            return view('customers.create', compact('identificationTypes'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $customer = Customer::create([
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'credit_score' => $request->credit_score,
                'employment_details' => $request->employment_details ? array_values($request->employment_details) : null,
            ]);

            foreach ($request->identifications as $identification) {
                CustomerIdentification::create([
                    'customer_id' => $customer->customer_id,
                    'identification_type_id' => $identification['identification_type_id'],
                    'identification_number' => $identification['identification_number'],
                    'issuing_authority' => $identification['issuing_authority'],
                    'expiry_date' => $identification['expiry_date'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('customers.show', $customer->customer_id)->with('success', 'Customer added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): View|RedirectResponse
    {
        try {
            $customer->load(['identifications.identificationType', 'accounts.category', 'accounts.branch', 'loans.loanType']);

            return view('customers.show', compact('customer'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View|RedirectResponse
    {
        try {
            $customer->load(['identifications']);
            $identificationTypes = IdentificationTypeEnum::all();

            return view('customers.edit', compact('customer', 'identificationTypes'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $customer->update([
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'credit_score' => $request->credit_score,
                'employment_details' => $request->employment_details ? array_values($request->employment_details) : null,
            ]);

            $customer->identifications()->delete();

            foreach ($request->identifications as $identification) {
                CustomerIdentification::create([
                    'customer_id' => $customer->customer_id,
                    'identification_type_id' => $identification['identification_type_id'],
                    'identification_number' => $identification['identification_number'],
                    'issuing_authority' => $identification['issuing_authority'],
                    'expiry_date' => $identification['expiry_date'] ?? null,
                ]);
            }
            DB::commit();

            return redirect()->route('customers.show', $customer->customer_id)->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        try {
            $customer->delete();

            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
