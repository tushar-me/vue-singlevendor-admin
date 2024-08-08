<?php

namespace Database\Seeders;

use App\Models\Variation;
use App\Models\VariationOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Variation::factory(20)
            ->has(VariationOption::factory(5))
            ->create();
    }
}
