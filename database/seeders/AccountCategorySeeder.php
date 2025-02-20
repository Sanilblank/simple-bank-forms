<?php

namespace Database\Seeders;

use App\Models\AccountCategory;
use App\Models\AccountTypeEnum;
use Illuminate\Database\Seeder;

class AccountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $savings = AccountTypeEnum::create(['account_type_value' => 'Savings']);
        $checking = AccountTypeEnum::create(['account_type_value' => 'Checking']);

        AccountCategory::insert([
            [
                'account_type_id' => $savings->account_type_id,
                'account_category_value' => 'Bachat Account',
                'interest_rate' => 5.5,
                'withdrawal_limit' => 10000,
                'minimum_balance' => 500,
            ],
            [
                'account_type_id' => $savings->account_type_id,
                'account_category_value' => 'Umanga Bachat Account',
                'interest_rate' => 5.7,
                'withdrawal_limit' => 10000,
                'minimum_balance' => 300,
            ],
            [
                'account_type_id' => $checking->account_type_id,
                'account_category_value' => 'Salary Account',
                'interest_rate' => 7.5,
                'withdrawal_limit' => 20000,
                'minimum_balance' => 1500,
            ],
            [
                'account_type_id' => $checking->account_type_id,
                'account_category_value' => 'Normal Checking Account',
                'interest_rate' => 6.5,
                'withdrawal_limit' => 15000,
                'minimum_balance' => 1000,
            ],
        ]);
    }
}
