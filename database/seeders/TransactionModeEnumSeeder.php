<?php

namespace Database\Seeders;

use App\Models\TransactionModeEnum;
use Illuminate\Database\Seeder;

class TransactionModeEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionModeEnum::insert([
            [
                'transaction_mode_value' => 'Cheque',
            ],
            [
                'transaction_mode_value' => 'Cash',
            ],
            [
                'transaction_mode_value' => 'Card',
            ],
            [
                'transaction_mode_value' => 'ATM',
            ],
            [
                'transaction_mode_value' => 'Mobile Banking',
            ],
        ]);
    }
}
