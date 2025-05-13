<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            ['name' => 'TVBDG', 'region' => 'BANDENGAN'],
            ['name' => 'TVBKS', 'region' => 'BEKASI'],
            ['name' => 'TVBLP', 'region' => 'HARMONI'],
            ['name' => 'TVBTG', 'region' => 'BITUNG'],
            ['name' => 'TVBTL', 'region' => 'BATU TULIS'],
            ['name' => 'TVCLI', 'region' => 'CILEUNGSI'],
            ['name' => 'TVFWT', 'region' => 'FATMAWATI'],
            ['name' => 'TVKCI', 'region' => 'KARAWACI'],
            ['name' => 'TVKGV', 'region' => 'KELAPA GADING V'],
            ['name' => 'TVKJR', 'region' => 'KEBON JERUK'],
            ['name' => 'TVKLD', 'region' => 'KLENDER'],
            ['name' => 'TVKRW', 'region' => 'KARAWANG'],
            ['name' => 'TVMED', 'region' => 'KELAPA GADING VSP'],
            ['name' => 'TVPDG', 'region' => 'PONDOK GEDE'],
            ['name' => 'TVPDC', 'region' => 'PONDOK CABE'],
            ['name' => 'TVPIN', 'region' => 'PONDOK INDAH'],
            ['name' => 'TVTGR', 'region' => 'TANGERANG'],
            ['name' => 'TVYOS', 'region' => 'YOS SUDARSO'],
            ['name' => 'TRUST', 'region' => 'TRADE IN'],
        ];

        // Masukkan ke table branches
        DB::table('branches')->insert($branches);
    }
}
