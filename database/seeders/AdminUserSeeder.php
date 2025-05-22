<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_users')->insert([
            'name' => 'Admin',
            'email' => 'ticketsewa@gmail.com',
            'password' => Hash::make('Ticket123@'),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
