<?php

namespace App\Console\Commands;

use App\CommandTrait;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionModeEnum;
use App\Models\TransactionTypeEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateTransaction extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a transaction data.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $account_id = $this->askValid(
                'Enter account number:',
                'account_id',
                [
                    'required', function ($attribute, $value, $fail) {
                        if (! Account::where('account_id', $value)->exists()) {
                            $fail('The account does not exist');
                        }
                    },
                ]
            );

            $transactionTypes = TransactionTypeEnum::all();
            $transactionTypesString = '';

            foreach ($transactionTypes as $transactionType) {
                $transactionTypesString .= $transactionType->transaction_type_id.' - '.$transactionType->transaction_type_value.PHP_EOL;
            }

            $transaction_type_id = $this->askValid('Enter transaction type id:'.PHP_EOL.$transactionTypesString,
                'transaction_type_id', ['required', function ($attribute, $value, $fail) {
                    if (! TransactionTypeEnum::where('transaction_type_id', $value)->exists()) {
                        $fail('The transaction type does not exist');
                    }
                }]);

            $transactionModes = TransactionModeEnum::all();
            $transactionModesString = '';

            foreach ($transactionModes as $transactionMode) {
                $transactionModesString .= $transactionMode->transaction_mode_id.' - '.$transactionMode->transaction_mode_value.PHP_EOL;
            }

            $transaction_mode_id = $this->askValid('Enter transaction mode id:'.PHP_EOL.$transactionModesString,
                'transaction_mode_id', ['required', function ($attribute, $value, $fail) {
                    if (! TransactionModeEnum::where('transaction_mode_id', $value)->exists()) {
                        $fail('The transaction mode does not exist');
                    }
                }]);

            $amount = $this->askValid('Enter amount:', 'amount', ['required', 'numeric', function ($attribute, $value, $fail) use ($transaction_type_id, $account_id) {
                if ($value < 0) {
                    $fail('The amount must be greater than 0');
                }

                if (
                    (int) $transaction_type_id !== TransactionTypeEnum::where('transaction_type_value', 'Deposit')->first()->transaction_type_id &&
                    $value > Account::where('account_id', $account_id)->first()->balance
                ) {
                    $fail('The amount must be less than or equal to the account balance');
                }
            }]);

            $date = $this->askValid('Enter date:', 'date', ['required', 'date', 'before_or_equal:today']);

            Transaction::create([
                'account_id' => $account_id,
                'transaction_type_id' => $transaction_type_id,
                'transaction_mode_id' => $transaction_mode_id,
                'amount' => $amount,
                'date' => $date,
            ]);

            $account = Account::where('account_id', $account_id)->first();

            if ((int) $transaction_type_id !== TransactionTypeEnum::where('transaction_type_value', 'Deposit')->first()->transaction_type_id) {
                $account->update([
                    'balance' => (float) $account->balance - (float) $amount,
                ]);
            } else {
                $account->update([
                    'balance' => (float) $account->balance + (float) $amount,
                ]);
            }

            DB::commit();
            $this->info('Transaction created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error($e);

            $this->error($e->getMessage());
        }
    }
}
