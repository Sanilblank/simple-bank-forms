<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Loan;
use App\Models\LoanTypeEnum;
use App\Models\Transaction;
use App\Models\TransactionModeEnum;
use App\Models\TransactionTypeEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        try {
            $activeAccountsPerBranch = Branch::withCount('accounts')->pluck('accounts_count', 'name');

            $loanTypes = LoanTypeEnum::all();
            $totalLoans = [];
            $approvedLoans = [];
            $rejectedLoans = [];
            $pendingLoans = [];
            $pendingPercentage = [];
            $approvedPercentage = [];
            $rejectedPercentage = [];

            foreach ($loanTypes as $loanType) {
                $totalLoans[$loanType->loan_type_value] = Loan::where('loan_type_id', $loanType->loan_type_id)->count();
                $pendingLoans[$loanType->loan_type_value] = Loan::where('loan_type_id', $loanType->loan_type_id)->where('approval_status', 'Pending')->count();
                $approvedLoans[$loanType->loan_type_value] = Loan::where('loan_type_id', $loanType->loan_type_id)->where('approval_status', 'Approved')->count();
                $rejectedLoans[$loanType->loan_type_value] = Loan::where('loan_type_id', $loanType->loan_type_id)->where('approval_status', 'Rejected')->count();

                $pendingPercentage[] = ($totalLoans[$loanType->loan_type_value] !== 0) ? $pendingLoans[$loanType->loan_type_value] / $totalLoans[$loanType->loan_type_value] * 100 : 0;
                $approvedPercentage[] = ($totalLoans[$loanType->loan_type_value] !== 0) ? $approvedLoans[$loanType->loan_type_value] / $totalLoans[$loanType->loan_type_value] * 100 : 0;
                $rejectedPercentage[] = ($totalLoans[$loanType->loan_type_value] !== 0) ? $rejectedLoans[$loanType->loan_type_value] / $totalLoans[$loanType->loan_type_value] * 100 : 0;
            }

            $transactionTypes = TransactionTypeEnum::all();
            $transactionTypeArray = [];

            foreach ($transactionTypes as $transactionType) {
                $transactionTypeArray[$transactionType->transaction_type_value] = Transaction::where('transaction_type_id', $transactionType->transaction_type_id)->count();
            }

            $transactionModes = TransactionModeEnum::all();
            $transactionModeArray = [];

            foreach ($transactionModes as $transactionMode) {
                $transactionModeArray[$transactionMode->transaction_mode_value] = Transaction::where('transaction_mode_id', $transactionMode->transaction_mode_id)->count();
            }

            return view('home', compact(
                'activeAccountsPerBranch',
                'totalLoans',
                'pendingPercentage',
                'approvedPercentage',
                'rejectedPercentage',
                'transactionTypeArray',
                'transactionModeArray',
            ));
        } catch (\Exception $e) {
            logger()->error($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
