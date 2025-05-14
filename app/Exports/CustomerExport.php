<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterExport;

class CustomerExport implements FromQuery, WithMapping, WithHeadings, WithEvents
{
    public function query()
    {
        return Customer::query()
            ->where('progress', 'tidak valid');
    }

    public function headings(): array
    {
        return [
            'ID', 'Branch ID', 'Salesman ID', 'Nama', 'Alamat',
            'No. HP 1', 'No. HP 2', 'Kelurahan', 'Kecamatan', 'Kota',
            'Tanggal Lahir', 'Jenis Kelamin', 'Tipe Pelanggan',
            'Jenis Pelanggan', 'Pekerjaan', 'Tenor', 'Tanggal Gatepass',
            'Model Mobil', 'Nomor Rangka', 'Sumber Data', 'Progress',
            'Saved', 'Alasan', 'Old Salesman',
            'Deleted At', 'Created At', 'Updated At',
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->branch_id,
            $customer->salesman_id,
            $customer->nama,
            $customer->alamat,
            $customer->nomor_hp_1,
            $customer->nomor_hp_2,
            $customer->kelurahan,
            $customer->kecamatan,
            $customer->kota,
            optional($customer->tanggal_lahir)->toDateString(),
            $customer->jenis_kelamin,
            $customer->tipe_pelanggan,
            $customer->jenis_pelanggan,
            $customer->pekerjaan,
            $customer->tenor,
            optional($customer->tanggal_gatepass)->toDateString(),
            $customer->model_mobil,
            $customer->nomor_rangka,
            $customer->sumber_data,
            $customer->progress,
            $customer->saved,
            $customer->alasan,
            $customer->old_salesman,
            optional($customer->deleted_at)->toDateTimeString(),
            optional($customer->created_at)->toDateTimeString(),
            optional($customer->updated_at)->toDateTimeString(),
        ];
    }

    /**
     * Jangan static, ini instance method!
     */
    public function registerEvents(): array
    {
        return [
            AfterExport::class => function(AfterExport $event) {
                // Hapus setelah export selesai
                Customer::where('progress', 'tidak valid')->delete();
            },
        ];
    }
}
