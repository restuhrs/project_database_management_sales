<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;

class InvalidDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();

        // Ambil daftar kota yang ada di database secara unik
        $cities = Customer::select('kota')->distinct()->get();

        $customers = Customer::with(['branch', 'salesman'])
                    ->where('progress', 'tidak valid')
                    ->get();

        return view('Admin.InvalidData.Invaliddata', compact('branches', 'cities', 'customers'));
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
        // Hapus data customer berdasarkan ID
        $customers = Customer::findOrFail($id);
        $customers->delete();

        // Mengembalikan respons JSON setelah berhasil hapus
        return redirect()->route('admin.invaliddata')->with('deleted', 'Data berhasil dihapus!');
    }
}
