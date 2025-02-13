<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|RedirectResponse
    {
        try {
            $branches = Branch::orderBy('updated_at', 'desc')->get();

            return view('branches.index', compact('branches'));
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
            return view('branches.create');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request): RedirectResponse
    {
        try {
            Branch::create([
                'name' => $request->name,
                'location' => $request->location,
                'contact_number' => $request->contact_number,
            ]);

            return redirect()->route('branches.index')->with('success', 'Branch created successfully');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch): View|RedirectResponse
    {
        try {
            $branch->load('employees');

            return view('branches.show', compact('branch'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch): View|RedirectResponse
    {
        try {
            return view('branches.edit', compact('branch'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, Branch $branch): RedirectResponse
    {
        try {
            $branch->update([
                'name' => $request->name,
                'location' => $request->location,
                'contact_number' => $request->contact_number,
            ]);

            return redirect()->route('branches.index')->with('success', 'Branch updated successfully');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch): RedirectResponse
    {
        try {
            $branch->delete();

            return redirect()->route('branches.index')->with('success', 'Branch deleted successfully');
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
