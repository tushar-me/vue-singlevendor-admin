<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Month::updateOrCreate([
           'name' => 'January',
            'slug' => Str::slug('January'),
            'number' => 1
        ]);
        Month::updateOrCreate([
           'name' => 'February',
            'slug' => Str::slug('February'),
            'number' => 2
        ]);
        Month::updateOrCreate([
           'name' => 'March',
            'slug' => Str::slug('March'),
            'number' => 3
        ]);
        Month::updateOrCreate([
           'name' => 'April',
            'slug' => Str::slug('April'),
            'number' => 4
        ]);
        Month::updateOrCreate([
           'name' => 'May',
            'slug' => Str::slug('May'),
            'number' => 5
        ]);
        Month::updateOrCreate([
           'name' => 'June',
            'slug' => Str::slug('June'),
            'number' => 6
        ]);
        Month::updateOrCreate([
           'name' => 'July',
            'slug' => Str::slug('July'),
            'number' => 7
        ]);
        Month::updateOrCreate([
           'name' => 'August',
            'slug' => Str::slug('August'),
            'number' => 8
        ]);
        Month::updateOrCreate([
           'name' => 'September',
            'slug' => Str::slug('September'),
            'number' => 9
        ]);
        Month::updateOrCreate([
           'name' => 'October ',
            'slug' => Str::slug('October'),
            'number' => 10
        ]);
        Month::updateOrCreate([
           'name' => 'November ',
            'slug' => Str::slug('November'),
            'number' => 11
        ]);
        Month::updateOrCreate([
           'name' => 'December',
            'slug' => Str::slug('December'),
            'number' => 12
        ]);
    }
}
