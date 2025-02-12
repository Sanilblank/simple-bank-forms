<?php

namespace Database\Seeders;

use App\Models\IdentificationTypeEnum;
use Illuminate\Database\Seeder;

class IdentificationTypeEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IdentificationTypeEnum::insert([
            [
                'identification_type_value' => 'National ID',
            ],
            [
                'identification_type_value' => 'Passport',
            ],
            [
                'identification_type_value' => 'Driving License',
            ],
            [
                'identification_type_value' => 'Citizenship ID',
            ],
        ]);
    }
}
