<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        kelas::create(['nama_kelas' => 'Kelas A']);
        kelas::create(['nama_kelas' => 'Kelas B']);
        kelas::create(['nama_kelas' => 'Kelas C']);
    }
}
