<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Jugol Admin',
                'username' => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => Hash::make(12345678),
                'role'     => 'admin',
                'status'   => 'active',
            ],
            [
               'full_name' => 'Jugol Vendor',
                'username' => 'Vendor',
                'email'    => 'vendor@mail.com',
                'password' => Hash::make(12345678),
                'role'     => 'vendor',
                'status'   => 'active',
            ],
            [
               'full_name' => 'Jugol Customer',
                'username' => 'Customer',
                'email'    => 'customer@mail.com',
                'password' => Hash::make(12345678),
                'role'     => 'customer',
                'status'   => 'active',
            ]
        ]);
    }
}
