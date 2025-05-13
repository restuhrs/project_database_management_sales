<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class SalesmanProgressExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function collection()
    {
        // Ambil user dengan role salesman beserta relasi
        $salesmen = User::where('role', 'salesman')
            ->with(['branch', 'customers'])
            ->get();

        // Hitung statistik dan simpan dalam $this->data untuk digunakan di map()
        $this->data = $salesmen->map(function ($salesman) {
            $totalFollowUp = $salesman->customers->count();
            $totalSPK = $salesman->customers->where('progress', 'SPK')->count();
            $totalPending = $salesman->customers->where('progress', 'Pending')->count();
            $totalNonValid = $salesman->customers->where('progress', 'Invalid')->count();

            return [
                'salesman' => $salesman->name,
                'branch' => $salesman->branch->name ?? '-',
                'totalFollowUp' => $totalFollowUp,
                'totalSPK' => $totalSPK,
                'totalPending' => $totalPending,
                'totalNonValid' => $totalNonValid,
                'progressPercentage' => $totalFollowUp > 0 ? round(($totalFollowUp / $totalFollowUp) * 100, 2) : 0,
                'spkPercentage' => $totalFollowUp > 0 ? round(($totalSPK / $totalFollowUp) * 100, 2) : 0,
                'pendingPercentage' => $totalFollowUp > 0 ? round(($totalPending / $totalFollowUp) * 100, 2) : 0,
                'nonValidPercentage' => $totalFollowUp > 0 ? round(($totalNonValid / $totalFollowUp) * 100, 2) : 0,
            ];
        });

        return $this->data;
    }

    public function map($row): array
    {
        return [
            $row['salesman'],
            $row['branch'],
            $row['totalFollowUp'],
            $row['totalSPK'],
            $row['totalPending'],
            $row['totalNonValid'],
            $row['progressPercentage'],
            $row['spkPercentage'],
            $row['pendingPercentage'],
            $row['nonValidPercentage'],
        ];
    }

    public function headings(): array
    {
        return [
            'Salesman',
            'Cabang',
            'Total Follow Up',
            'Total SPK',
            'Total Pending',
            'Total Non-valid',
            'Total Progress (%)',
            'Total SPK (%)',
            'Total Pending (%)',
            'Total Non-valid (%)',
        ];
    }
}
