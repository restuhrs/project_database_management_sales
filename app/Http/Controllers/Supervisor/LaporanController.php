<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan ID supervisor yang sedang login
        $supervisorId = auth()->user()->id;

        // Ambil salesmen yang ada di bawah naungan supervisor yang login
        $salesmen = User::where('role', 'salesman')
            ->whereHas('supervisors', function ($query) use ($supervisorId) {
                $query->where('supervisor_id', $supervisorId); // Pastikan salesman terkait dengan supervisor yang login
            })
            ->with('customers.branch') // Muat relasi branch dari customer
            ->get();

        // Process data untuk menghitung persentase dan data lainnya
        $salesmanProgress = $salesmen->map(function ($salesman) {
            $totalFollowUp = $salesman->customers->count();
            $totalSPK = $salesman->customers->where('progress', 'SPK')->count();
            $totalPending = $salesman->customers->where('progress', 'pending')->count();
            $totalNonValid = $salesman->customers->where('progress', 'invalid')->count();

            // Dapatkan nama cabang dari relasi customer
            $branchName = $salesman->branch->name ?? 'N/A'; // Using the first related customer's branch

            // Menghitung persentase
            $progressPercentage = $totalFollowUp > 0 ? ($totalFollowUp / $totalFollowUp) * 100 : 0;
            $spkPercentage = $totalFollowUp > 0 ? ($totalSPK / $totalFollowUp) * 100 : 0;
            $pendingPercentage = $totalFollowUp > 0 ? ($totalPending / $totalFollowUp) * 100 : 0;
            $nonValidPercentage = $totalFollowUp > 0 ? ($totalNonValid / $totalFollowUp) * 100 : 0;

            return [
                'salesman' => $salesman->name,
                'branch' => $branchName,
                'totalFollowUp' => $totalFollowUp,
                'totalSPK' => $totalSPK,
                'totalPending' => $totalPending,
                'totalNonValid' => $totalNonValid,
                'progressPercentage' => round($progressPercentage, 2),
                'spkPercentage' => round($spkPercentage, 2),
                'pendingPercentage' => round($pendingPercentage, 2),
                'nonValidPercentage' => round($nonValidPercentage, 2),
            ];
        });

        // Ambil semua cabang untuk filter dropdown (Hanya cabang yang relevan untuk supervisor)
        $branches = Branch::all();

        // Kirim data ke view
        return view('Supervisor.Laporan.Laporan', compact('salesmanProgress', 'branches'));
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
