<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'name' => 'Operator User',
            'email' => 'operator@operator.com',
            'role' => 'operator',
            'password' => bcrypt('123'),
        ]);
    }
}
