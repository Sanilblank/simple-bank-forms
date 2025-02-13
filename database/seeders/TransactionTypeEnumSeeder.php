<?php

namespace Database\Seeders;

use App\Models\TransactionTypeEnum;
use Illuminate\Database\Seeder;

class TransactionTypeEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionTypeEnum::insert([
            [
                'transaction_type_value' => 'Deposit',
            ],
            [
                'transaction_type_value' => 'Withdrawal',
            ],
            [
                'transaction_type_value' => 'Transfer',
            ],
        ]);
    }
}
