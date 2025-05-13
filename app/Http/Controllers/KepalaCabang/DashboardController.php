<?php

namespace App\Http\Controllers\KepalaCabang;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil cabang kepala cabang yang login
        $branchId = auth()->user()->branch_id;

        $allCustomers = Customer::where('branch_id', $branchId)
            ->with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc') // Sort by the latest
            ->get();

        // Ambil semua customer yang memiliki salesman dengan cabang yang sesuai dengan cabang kepala cabang yang login
        $validCustomers = Customer::whereHas('salesman', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);  // Pastikan salesman terkait dengan cabang yang sama
        })
            ->whereNotIn('progress', ['tidak valid'])
            ->whereNotNull('salesman_id')
            ->with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Menghitung total customer
        $totalAllCustomers = $allCustomers->count();
        $totalValidCustomers = $validCustomers->count();
        $invalidCount = $validCustomers->where('progress', 'tidak valid')->count();

        // Menghitung follow-ups dan saved customers
        $followUpCount = $validCustomers->whereIn('progress', [ 'DO', 'SPK', 'Pending', 'tidak valid'])->count();
        $savedCount = $validCustomers->where('saved', 1)->count();

        // Group by salesman dengan perhitungan yang sesuai
        $salesman_goals = [];
        $salesmanIds = []; // Untuk menjaga urutan salesman

        foreach ($validCustomers as $index => $customer) {
            $salesman = $customer->salesman;
            if ($salesman) {
                if (!isset($salesman_goals[$salesman->id])) {
                    $salesman_goals[$salesman->id] = [
                        'no' => count($salesmanIds) + 1, // Nomor urut
                        'branch' => $salesman->branch,
                        'salesman' => $salesman,
                        'total_customers' => 0,
                        'follow_up_count' => 0,
                        'saved_count' => 0,
                        'latest_customer' => $customer->created_at // Untuk sorting
                    ];
                    $salesmanIds[] = $salesman->id;
                }

                // Increment counters
                $salesman_goals[$salesman->id]['total_customers']++;

                // Count follow-ups
                if (in_array($customer->progress, ['DO', 'SPK', 'Pending', 'tidak valid'])) {
                    $salesman_goals[$salesman->id]['follow_up_count']++;
                }

                // Count saved customers
                if ($customer->saved == 1) {
                    $salesman_goals[$salesman->id]['saved_count']++;
                }

                // Update latest customer date if newer
                if ($customer->created_at > $salesman_goals[$salesman->id]['latest_customer']) {
                    $salesman_goals[$salesman->id]['latest_customer'] = $customer->created_at;
                }
            }
        }

        // Sort salesmen by latest customer date (newest first)
        usort($salesman_goals, function ($a, $b) {
            return $b['latest_customer'] <=> $a['latest_customer'];
        });

        // Re-number the salesmen after sorting
        foreach ($salesman_goals as $index => &$salesman) {
            $salesman['no'] = $index + 1;
        }

        // Ambil semua cabang untuk filter kota
        $cities = Branch::select('name as city')
            ->whereNotNull('name')
            ->where('id', $branchId) // Hanya ambil cabang yang terkait dengan kepala cabang yang login
            ->distinct()
            ->orderBy('name')
            ->pluck('city');

        // Kirim data ke view
        return view('kacab.Dashboard.Dashboard', compact(
            'totalAllCustomers',        // Add this variable to the compact() to pass it to the view
            'totalValidCustomers',
            'invalidCount',
            'followUpCount',
            'savedCount',
            'salesman_goals',
            'cities'
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
