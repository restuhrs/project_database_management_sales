<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil user yang login (salesman)
        $salesman = auth()->user(); // Ambil data lengkap user login

        // Ambil seluruh data customer dengan cabang yang sama & saved = 0
        $customers = Customer::where('branch_id', $salesman->branch_id)
            ->where('saved', 0)
            ->with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Salesman.Dashboard.Dashboard', compact('customers'));
    }

    // fungsi save customer
    public function saveCustomer($id)
    {
        // Mencari customer berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Pastikan hanya salesman dari cabang yang sama yang dapat menyimpan customer
        if ($customer->branch_id === auth()->user()->branch_id) {
            // Tandai customer yang disimpan dan set ID salesman yang sedang login
            $customer->saved = 1;
            $customer->salesman_id = auth()->user()->id;  // Update id_salesman dengan ID salesman yang menekan tombol
            $customer->save();

            // Kembali ke halaman sebelumnya
            return redirect()->back();
        }

        // Jika cabang tidak sesuai, tampilkan error 403
        abort(403, 'Tidak memiliki akses untuk menyimpan customer ini.');
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
