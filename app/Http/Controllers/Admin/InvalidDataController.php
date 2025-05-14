<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExport;

class InvalidDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        $cities   = Customer::select('kota')->distinct()->get();
        $customers = Customer::with(['branch', 'salesman'])
                    ->where('progress', 'tidak valid')
                    ->get();

        return view('Admin.InvalidData.Invaliddata', compact('branches', 'cities', 'customers'));
    }

    /**
     * Export invalid customers, hapus mereka, lalu kirim file.
     */
    public function export()
    {
        // 1. Tentukan nama file
        $fileName = 'customers_invalid_' . now()->format('Ymd_His') . '.xlsx';

        // 2. Generate dan simpan Excel ke storage/app/temp
        Excel::store(new CustomerExport, "temp/{$fileName}", 'local');

        // 3. Hapus data invalid dari database
        Customer::where('progress', 'tidak valid')->delete();

        // 4. Download file, lalu hapus file dari disk setelah terkirim
        $fullPath = storage_path("app/temp/{$fileName}");
        return response()
            ->download($fullPath, $fileName)
            ->deleteFileAfterSend(true);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()
            ->route('admin.invaliddata')
            ->with('deleted', 'Data berhasil dihapus!');
    }
}
