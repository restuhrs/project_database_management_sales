<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the logged-in salesman
        $salesman = auth()->user(); // This gets the logged-in salesman

        // Initialize counters for the different statuses
        $totalFollowUp = 0;
        $totalSPK = 0;
        $totalPending = 0;
        $totalNonValid = 0;

        // Process the customer's data
        foreach ($salesman->customers as $customer) {
            // Count total customers and their statuses
            $totalFollowUp++;
            if ($customer->progress == 'SPK') {
                $totalSPK++;
            }
            if ($customer->progress == 'pending') {
                $totalPending++;
            }
            if ($customer->progress == 'invalid') {
            $totalNonValid++;
            }
        }

        // Calculate percentages
        $progressPercentage = $totalFollowUp > 0 ? ($totalFollowUp / $totalFollowUp) * 100 : 0;
        $spkPercentage = $totalFollowUp > 0 ? ($totalSPK / $totalFollowUp) * 100 : 0;
        $pendingPercentage = $totalFollowUp > 0 ? ($totalPending / $totalFollowUp) * 100 : 0;
        $nonValidPercentage = $totalFollowUp > 0 ? ($totalNonValid / $totalFollowUp) * 100 : 0;

        // Prepare the data to send to the view
        $salesmanProgress = [
            'salesman' => $salesman->name,
            'branch' => $salesman->customers->first()->branch->name ?? 'N/A', // Get the branch from the first customer
            'totalFollowUp' => $totalFollowUp,
            'totalSPK' => $totalSPK,
            'totalPending' => $totalPending,
            'totalNonValid' => $totalNonValid,
            'progressPercentage' => round($progressPercentage, 2),
            'spkPercentage' => round($spkPercentage, 2),
            'pendingPercentage' => round($pendingPercentage, 2),
            'nonValidPercentage' => round($nonValidPercentage, 2),
        ];

        // Get all branches for the dropdown filter (optional)
        $branches = Branch::all();

        // Return the data to the view
        return view('Salesman.Laporan.Laporan', compact('salesmanProgress', 'branches'));
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
