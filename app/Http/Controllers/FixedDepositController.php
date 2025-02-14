<?php

namespace App\Http\Controllers;

use App\Models\FixedDeposit;

class FixedDepositController extends Controller
{
    public function index()
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
