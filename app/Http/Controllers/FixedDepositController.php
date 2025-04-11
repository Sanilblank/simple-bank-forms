<?php

namespace App\Http\Controllers;

use App\Models\FixedDeposit;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FixedDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        try {
            $fixedDeposits = FixedDeposit::orderBy('updated_at', 'desc')->with(['customer', 'account'])->get();

            return view('fixed-deposits.index', compact('fixedDeposits'));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
