<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalesmanProgressExport;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua user role 'salesman' dan cabang langsung
        $salesmen = User::where('role', 'salesman')
            ->with(['branch', 'customers']) // ambil langsung cabang dari user, bukan dari customer
            ->get();

        // Proses data sales
        $salesmanProgress = $salesmen->map(function ($salesman) {
            $totalFollowUp = $salesman->customers->count();
            $totalSPK = $salesman->customers->where('progress', 'SPK')->count();
            $totalPending = $salesman->customers->where('progress', 'pending')->count();
            $totalNonValid = $salesman->customers->where('progress', 'tidak valid')->count();

            // Hitung persentase
            $progressPercentage = $totalFollowUp > 0 ? 100 : 0;
            $spkPercentage = $totalFollowUp > 0 ? ($totalSPK / $totalFollowUp) * 100 : 0;
            $pendingPercentage = $totalFollowUp > 0 ? ($totalPending / $totalFollowUp) * 100 : 0;
            $nonValidPercentage = $totalFollowUp > 0 ? ($totalNonValid / $totalFollowUp) * 100 : 0;

            return [
                'salesman' => $salesman->name,
                'branch' => $salesman->branch->name ?? 'N/A', // ambil dari relasi branch langsung
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

        // Ambil semua cabang
        $branches = Branch::all();

        return view('Admin.Laporan.Laporan', compact('salesmanProgress', 'branches'));
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
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }

    public function export()
    {
        return Excel::download(new SalesmanProgressExport, 'salesman_progress.xlsx');
    }
}
