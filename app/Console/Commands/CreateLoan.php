<?php

namespace App\Console\Commands;

use App\CommandTrait;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\LoanTypeEnum;
use Illuminate\Console\Command;

class CreateLoan extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-loan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a loan data for a customer.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $customer_id = $this->askValid(
                'Enter customer id:',
                'customer_id',
                [
                    'required', function ($attribute, $value, $fail) {
                        if (! Customer::where('customer_id', $value)->exists()) {
                            $fail('The customer does not exist');
                        }
                    },
                ]
            );

            $loanTypes = LoanTypeEnum::all();
            $loanTypesString = '';

            foreach ($loanTypes as $loanType) {
                $loanTypesString .= $loanType->loan_type_id.' - '.$loanType->loan_type_value.PHP_EOL;
            }

            $loan_type_id = $this->askValid('Enter transaction type id:'.PHP_EOL.$loanTypesString,
                'loan_type_id', ['required', function ($attribute, $value, $fail) {
                    if (! LoanTypeEnum::where('loan_type_id', $value)->exists()) {
                        $fail('The loan type does not exist');
                    }
                }]);

            $amount = $this->askValid('Enter amount:', 'amount', ['required', 'numeric', function ($attribute, $value, $fail) {
                if ($value < 0) {
                    $fail('The amount must be greater than 0');
                }
            }]);

            $interest_rate = $this->askValid('Enter interest rate in percentage:', 'interest_rate', ['required', 'numeric', function ($attribute, $value, $fail) {
                if ($value < 0) {
                    $fail('The interest rate must be greater than 0');
                }
            }]);

            $duration = $this->askValid('Enter duration in months:', 'duration', ['required', 'numeric', function ($attribute, $value, $fail) {
                if ($value < 0) {
                    $fail('The duration must be greater than 0');
                }
            }]);

            $repayment_schedule = $this->askValid('Enter information about the repayment schedule:', 'repayment_schedule', ['required', 'string', 'max:255']);

            Loan::create([
                'customer_id' => $customer_id,
                'loan_type_id' => $loan_type_id,
                'amount' => (float) $amount,
                'interest_rate' => (float) $interest_rate,
                'duration' => $duration,
                'approval_status' => 'Pending',
                'repayment_schedule' => $repayment_schedule,
            ]);

            $this->info('Loan created successfully');
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            logger()->error($e);
        }
    }
}
