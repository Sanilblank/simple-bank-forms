<?php

namespace App\Console\Commands;

use App\CommandTrait;
use App\Models\Account;
use App\Models\Customer;
use App\Models\FixedDeposit;
use Illuminate\Console\Command;

class CreateFixedDeposit extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-fixed-deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates data for fixed deposit.';

    /**
     * Execute the console command.
     */
    public function handle()
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

            $account_id = $this->askValid(
                'Enter account number:',
                'account_id',
                [
                    'required', function ($attribute, $value, $fail) use ($customer_id) {
                        if (! Account::where('account_id', $value)->where('customer_id', $customer_id)->exists()) {
                            $fail('The account does not exist');
                        }
                    },
                ]
            );

            $deposit_amount = $this->askValid('Enter deposit amount:', 'deposit_amount', ['required', 'numeric', function ($attribute, $value, $fail) use ($account_id) {
                if ($value < 0) {
                    $fail('The amount must be greater than 0');
                }

                if ($value > Account::where('account_id', $account_id)->first()->balance) {
                    $fail('The amount must be less than account balance');
                }
            }]);

            $interest_rate = $this->askValid('Enter interest rate in percentage:', 'interest_rate', ['required', 'numeric', function ($attribute, $value, $fail) {
                if ($value < 0) {
                    $fail('The interest rate must be greater than 0');
                }
            }]);

            $date = $this->askValid('Enter maturity date:', 'date', ['required', 'date', 'after:today']);

            FixedDeposit::create([
                'customer_id' => $customer_id,
                'account_id' => $account_id,
                'deposit_amount' => $deposit_amount,
                'interest_rate' => $interest_rate,
                'maturity_date' => $date,
            ]);

            $this->info('Fixed deposit created successfully');
        } catch (\Exception $e) {
            logger()->error($e);

            $this->error($e->getMessage());
        }
    }
}
