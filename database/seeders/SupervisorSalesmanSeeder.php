<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupervisorSalesmanSeeder extends Seeder
{
    public function run()
    {
        $supervisors = DB::table('user')
            ->where('role', 'supervisor')
            ->get()
            ->groupBy('branch_id');

        $salesmen = DB::table('user')
            ->where('role', 'salesman')
            ->get()
            ->groupBy('branch_id');

        foreach ($supervisors as $branchId => $branchSupervisors) {
            $branchSalesmen = $salesmen->get($branchId, collect());

            if ($branchSalesmen->isEmpty()) continue;

            foreach ($branchSupervisors as $supervisor) {
                // Each supervisor manages 5-10 salesmen from their branch
                $count = min(rand(5, 10), $branchSalesmen->count());
                $assignedSalesmen = $branchSalesmen->random($count);

                foreach ($assignedSalesmen as $salesman) {
                    DB::table('supervisor_salesman')->insert([
                        'supervisor_id' => $supervisor->id,
                        'salesman_id' => $salesman->id,
                        'created_at' => now()->subMonths(rand(1, 12)),
                        'updated_at' => now()->subMonths(rand(1, 12)),
                    ]);
                }
            }
        }
    }
}
