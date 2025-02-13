<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionModeEnum;
use App\Models\TransactionTypeEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateTransaction extends Command
{
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

            $amount = $this->askValid('Enter amount:', 'amount', ['required', 'numeric']);
            $date = $this->askValid('Enter date:', 'date', ['required', 'date']);

            Transaction::create([
                'account_id' => $account_id,
                'transaction_type_id' => $transaction_type_id,
                'transaction_mode_id' => $transaction_mode_id,
                'amount' => $amount,
                'date' => $date,
            ]);

            $this->info('Transaction created successfully');
        } catch (\Exception $e) {
            logger()->error($e);

            $this->error($e->getMessage());
        }
    }

    protected function askValid($question, $field, $rules): string
    {
        $value = $this->ask($question);
        $message = $this->validateInput($rules, $field, $value);

        if ($message) {
            $this->error($message);

            return $this->askValid($question, $field, $rules);
        }

        return $value;
    }

    protected function validateInput($rules, $fieldName, $value): ?string
    {
        $validator = Validator::make([
            $fieldName => $value,
        ], [
            $fieldName => $rules,
        ]);

        return $validator->fails()
            ? $validator->errors()->first($fieldName)
            : null;
    }
}
