<?php

namespace Database\Seeders;

use App\Models\LoanTypeEnum;
use Illuminate\Database\Seeder;

class LoanTypeEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoanTypeEnum::insert([
            [
                'loan_type_value' => 'Personal Loan',
            ],
            [
                'loan_type_value' => 'Home Loan',
            ],
            [
                'loan_type_value' => 'Business Loan',
            ],
        ]);
    }
}
