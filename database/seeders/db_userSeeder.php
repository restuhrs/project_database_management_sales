<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class db_userSeeder extends Seeder
{
    public function run()
    {
        // Indonesian names dataset
        $indonesianFirstNamesMale = [
            'Ahmad', 'Budi', 'Cahyo', 'Dedi', 'Eko', 'Fajar', 'Gunawan', 'Hadi', 'Irfan', 'Joko',
            'Kurniawan', 'Lukman', 'Mulyadi', 'Nugroho', 'Oki', 'Purnomo', 'Rahmat', 'Surya', 'Teguh', 'Wahyu'
        ];

        $indonesianFirstNamesFemale = [
            'Ani', 'Bunga', 'Citra', 'Dewi', 'Eka', 'Fitri', 'Gita', 'Hani', 'Intan', 'Juli',
            'Kartika', 'Lina', 'Maya', 'Nina', 'Oki', 'Putri', 'Rani', 'Sari', 'Tari', 'Wulan'
        ];

        $indonesianLastNames = [
            'Santoso', 'Wijaya', 'Prabowo', 'Hidayat', 'Kusuma', 'Setiawan', 'Pratama', 'Saputra', 'Nugroho', 'Suryanto',
            'Halim', 'Irawan', 'Susanto', 'Gunawan', 'Wibowo', 'Hartono', 'Tanuwijaya', 'Lim', 'Ong', 'Wijayanto'
        ];

        // 1. Create branches first (already handled by BranchesSeeder)
        $branches = \App\Models\Branch::all();

        // 2. Create 5 admin users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Admin' . $i,
                'username' => 'admin' . $i,
                'email' => 'admin' . $i . '@salesapp.com',
                'password' => Hash::make('password123'),
                'branch_id' => $branches->random()->id,
                'role' => 'admin',
                'status' => 'aktif',
                'created_at' => now()->subMonths(rand(1, 12)),
                'updated_at' => now()->subMonths(rand(1, 12)),
            ]);
        }

        // 3. Create 10 kepala cabang (branch managers)
        for ($i = 1; $i <= 10; $i++) {
            $gender = rand(0, 1) ? 'L' : 'P';
            $firstName = $gender == 'L'
                ? $indonesianFirstNamesMale[array_rand($indonesianFirstNamesMale)]
                : $indonesianFirstNamesFemale[array_rand($indonesianFirstNamesFemale)];

            User::create([
                'name' => $firstName . ' ' . $indonesianLastNames[array_rand($indonesianLastNames)],
                'username' => 'kacab' . $i,
                'email' => 'kacab' . $i . '@salesapp.com',
                'password' => Hash::make('password123'),
                'branch_id' => $branches->random()->id,
                'role' => 'kepala_cabang',
                'status' => 'aktif',
                'created_at' => now()->subMonths(rand(1, 12)),
                'updated_at' => now()->subMonths(rand(1, 12)),
            ]);
        }

        // 4. Create 20 supervisors
        for ($i = 1; $i <= 20; $i++) {
            $gender = rand(0, 1) ? 'L' : 'P';
            $firstName = $gender == 'L'
                ? $indonesianFirstNamesMale[array_rand($indonesianFirstNamesMale)]
                : $indonesianFirstNamesFemale[array_rand($indonesianFirstNamesFemale)];

            User::create([
                'name' => $firstName . ' ' . $indonesianLastNames[array_rand($indonesianLastNames)],
                'username' => 'spv' . $i,
                'email' => 'spv' . $i . '@salesapp.com',
                'password' => Hash::make('password123'),
                'branch_id' => $branches->random()->id,
                'role' => 'supervisor',
                'status' => 'aktif',
                'created_at' => now()->subMonths(rand(1, 12)),
                'updated_at' => now()->subMonths(rand(1, 12)),
            ]);
        }

        // 5. Create 100 salesman users with Indonesian names
        for ($i = 1; $i <= 100; $i++) {
            $gender = rand(0, 1) ? 'L' : 'P';
            $firstName = $gender == 'L'
                ? $indonesianFirstNamesMale[array_rand($indonesianFirstNamesMale)]
                : $indonesianFirstNamesFemale[array_rand($indonesianFirstNamesFemale)];

            $lastName = $indonesianLastNames[array_rand($indonesianLastNames)];

            User::create([
                'name' => $firstName . ' ' . $lastName,
                'username' => strtolower($firstName[0]) . strtolower($lastName) . $i,
                'email' => strtolower($firstName[0]) . strtolower($lastName) . $i . '@salesapp.com',
                'password' => Hash::make('password123'),
                'branch_id' => $branches->random()->id,
                'role' => 'salesman',
                'status' => 'aktif',
                'created_at' => now()->subMonths(rand(1, 12)),
                'updated_at' => now()->subMonths(rand(1, 12)),
            ]);
        }
    }
}
