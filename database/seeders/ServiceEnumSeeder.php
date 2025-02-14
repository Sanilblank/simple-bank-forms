<?php

namespace Database\Seeders;

use App\Models\ServiceEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceEnum::insert([
            [
                'service_name' => 'ATM Card',
            ],
            [
                'service_name' => 'Mobile Banking',
            ],
            [
                'service_name' => 'Cheque',
            ],
        ]);
    }
}
