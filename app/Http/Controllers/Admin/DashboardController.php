<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSalesmanGoals;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Customer;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all customers including invalid ones for total count
        $allCustomers = Customer::with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc') // Urutkan dari yang terbaru
            ->get();

        // Fetch valid customers with salesman, ordered by latest
        $validCustomers = Customer::whereNotIn('progress', ['tidak valid'])
            ->whereNotNull('salesman_id')
            ->whereHas('salesman', function ($query) {
                $query->whereNotNull('branch_id');
            })
            ->with(['salesman.branch']) // muat relasi branch dari salesman
            ->orderBy('created_at', 'desc')
            ->get();

        // Counting customers
        $totalAllCustomers = $allCustomers->count();
        $totalValidCustomers = $validCustomers->count();
        $invalidCount = $allCustomers->where('progress', 'tidak valid')->count();

        // Counting follow-ups and saved customers
        $followUpCount = $validCustomers->whereIn('progress', ['DO', 'SPK', 'Pending', 'tidak valid'])->count();
        $savedCount = $validCustomers->where('saved', 1)->count();

        // Group by salesman with proper counting
        $admin_salesman_goals = [];
        $salesmanIds = []; // Untuk menjaga urutan salesman

        foreach ($validCustomers as $index => $customer) {
            $salesman = $customer->salesman;
            if ($salesman) {
                if (!isset($admin_salesman_goals[$salesman->id])) {
                    $admin_salesman_goals[$salesman->id] = [
                        'no' => count($salesmanIds) + 1,
                        'branch' => $salesman->branch, // Cabang dari salesman, bukan customer
                        'salesman' => $salesman,
                        'total_customers' => 0,
                        'follow_up_count' => 0,
                        'saved_count' => 0,
                        'latest_customer' => $customer->created_at
                    ];
                    $salesmanIds[] = $salesman->id;
                }

                $admin_salesman_goals[$salesman->id]['total_customers']++;

                if (in_array($customer->progress, ['DO', 'SPK', 'Pending', 'tidak valid'])) {
                    $admin_salesman_goals[$salesman->id]['follow_up_count']++;
                }

                if ($customer->saved == 1) {
                    $admin_salesman_goals[$salesman->id]['saved_count']++;
                }

                if ($customer->created_at > $admin_salesman_goals[$salesman->id]['latest_customer']) {
                    $admin_salesman_goals[$salesman->id]['latest_customer'] = $customer->created_at;
                }
            }
        }

        // Sort salesmen by latest customer date (newest first)
        usort($admin_salesman_goals, function ($a, $b) {
            return $b['latest_customer'] <=> $a['latest_customer'];
        });

        // Re-number the salesmen after sorting
        foreach ($admin_salesman_goals as $index => &$salesman) {
            $salesman['no'] = $index + 1;
        }

        // Ambil daftar cabang yang ada di database secara unik
        $branches = Branch::all(); // Jika nama model cabang adalah Branch


        return view('Admin.Dashboard.Dashboard', compact(
            'totalAllCustomers',
            'totalValidCustomers',
            'invalidCount',
            'followUpCount',
            'savedCount',
            'admin_salesman_goals',
            'branches'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
