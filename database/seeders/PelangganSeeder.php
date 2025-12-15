<?php

namespace Database\Seeders;

use App\Models\Pelanggans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggans::create([
            'nama' => 'John Doe',
            'daerah' => 'Jakarta',
        ]);
    }
}
