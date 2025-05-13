<?php

namespace App\Http\Controllers\Supervisor;

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
        // Get the supervisor ID of the currently logged-in user
        $supervisorId = auth()->user()->id;

        // Fetch all customers with their related salesman (those supervised by the logged-in supervisor)
        $allCustomers = Customer::with(['branch', 'salesman'])
            ->whereHas('salesman', function ($query) use ($supervisorId) {
                $query->whereHas('supervisors', function ($q) use ($supervisorId) {
                    $q->where('supervisor_id', $supervisorId); // Filter salesman by supervisor
                });
            })
            ->orderBy('created_at', 'desc') // Sort by the latest
            ->get();

        // Fetch valid customers (those with progress not 'tidak valid') and their related salesman, ordered by the latest
        $validCustomers = Customer::whereNotIn('progress', ['tidak valid'])
            ->whereNotNull('salesman_id')
            ->whereHas('salesman', function ($query) use ($supervisorId) {
                $query->whereHas('supervisors', function ($q) use ($supervisorId) {
                    $q->where('supervisor_id', $supervisorId); // Filter salesman by supervisor
                });
            })
            ->with(['salesman.branch']) // Load the branch related to each salesman
            ->orderBy('created_at', 'desc')
            ->get();

        // Count total customers and valid customers
        $totalAllCustomers = $allCustomers->count();
        $totalValidCustomers = $validCustomers->count();
        $invalidCount = $allCustomers->where('progress', 'tidak valid')->count();

        // Count follow-ups and saved customers
        $followUpCount = $validCustomers->whereIn('progress', ['Pending', 'SPK', 'DO'])->count();
        $savedCount = $validCustomers->where('saved', 1)->count();

        // Group by salesman and calculate relevant stats
        $salesman_goals = [];
        $salesmanIds = []; // To maintain salesman order

        foreach ($validCustomers as $index => $customer) {
            $salesman = $customer->salesman;
            if ($salesman) {
                if (!isset($salesman_goals[$salesman->id])) {
                    $salesman_goals[$salesman->id] = [
                        'no' => count($salesmanIds) + 1, // Numbering the salesman
                        'branch' => $salesman->branch->name ?? 'N/A', // Get branch name from salesman
                        'salesman' => $salesman,
                        'total_customers' => 0,
                        'follow_up_count' => 0,
                        'saved_count' => 0,
                        'latest_customer' => $customer->created_at // For sorting purposes
                    ];
                    $salesmanIds[] = $salesman->id;
                }

                // Increment the counters
                $salesman_goals[$salesman->id]['total_customers']++;

                if (in_array($customer->progress, ['Pending', 'SPK', 'DO'])) {
                    $salesman_goals[$salesman->id]['follow_up_count']++;
                }

                if ($customer->saved == 1) {
                    $salesman_goals[$salesman->id]['saved_count']++;
                }

                if ($customer->created_at > $salesman_goals[$salesman->id]['latest_customer']) {
                    $salesman_goals[$salesman->id]['latest_customer'] = $customer->created_at;
                }
            }
        }

        // Sort salesman by latest customer date (newest first)
        usort($salesman_goals, function ($a, $b) {
            return $b['latest_customer'] <=> $a['latest_customer'];
        });

        // Re-number the salesman after sorting
        foreach ($salesman_goals as $index => &$salesman) {
            $salesman['no'] = $index + 1;
        }

        // Get unique cities based on the salesman's branch
        $cities = Branch::select('name as city')
            ->whereNotNull('name')
            ->distinct()
            ->orderBy('name')
            ->pluck('city');

        // Return view with the processed data
        return view('Supervisor.Dashboard.Dashboard', compact(
            'totalAllCustomers',
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
