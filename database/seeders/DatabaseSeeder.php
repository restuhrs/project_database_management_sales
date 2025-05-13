<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BranchSeeder::class,
            db_userSeeder::class,            // Depends on branches
            SupervisorSalesmanSeeder::class, // Depends on user
            CustomersSeeder::class,          // Depends on branches and user
        ]);
    }
}
