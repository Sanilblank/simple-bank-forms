<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
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
    public function create($branch_id): View|RedirectResponse
    {
        try {
            $branch = Branch::find($branch_id);

            return view('employees.create', compact('branch'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($branch_id, EmployeeRequest $request): RedirectResponse
    {
        try {
            Employee::create([
                'name' => $request->name,
                'role' => $request->role,
                'contact_number' => $request->contact_number,
                'branch_id' => $branch_id,
                'is_branch_manager' => $request->is_branch_manager,
            ]);

            return redirect()->route('branches.show', $branch_id)->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($branch_id, Employee $employee): View|RedirectResponse
    {
        try {
            $branch = Branch::find($branch_id);

            return view('employees.show', compact('employee', 'branch'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($branch_id, Employee $employee): View|RedirectResponse
    {
        try {
            $branch = Branch::find($branch_id);

            return view('employees.edit', compact('employee', 'branch'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($branch_id, EmployeeRequest $request, Employee $employee): RedirectResponse
    {
        try {
            $employee->update([
                'name' => $request->name,
                'role' => $request->role,
                'contact_number' => $request->contact_number,
                'is_branch_manager' => $request->is_branch_manager,
            ]);

            return redirect()->route('branches.show', $branch_id)->with('success', 'Employee updated successfully');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($branch_id, Employee $employee): RedirectResponse
    {
        try {
            $employee->delete();

            return redirect()->route('branches.show', $branch_id)->with('success', 'Employee deleted successfully');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
