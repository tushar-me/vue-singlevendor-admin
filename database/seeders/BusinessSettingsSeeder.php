<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
              [
                  'type' => 'currency',
                  'value' => 'Taka'
              ],

            [
                'type' => 'currency_symbol',
                'value' => '৳'
            ],
        ];

        BusinessSetting::query()->insert($data);
    }
}
