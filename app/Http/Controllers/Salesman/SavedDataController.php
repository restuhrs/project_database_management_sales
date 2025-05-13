<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;

class SavedDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan ID salesman yang login
        $salesmanId = auth()->user()->id;

        // Ambil customer yang sudah disimpan oleh salesman
        $savedCustomers = Customer::where('salesman_id', $salesmanId)
            ->where('saved', 1) // Status saved = 1
            ->with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Salesman.SavedData.SavedData', compact('savedCustomers'));
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
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
        ]);

        $customer = Customer::find($request->customer_id);

        //Pastikan hanya salesman yang terkait yang boleh menyimpan
        // if ($customer->salesman_id !== auth()->id()) {
        //     abort(403, 'Unauthorized action.');
        // }

        $customer->saved = 1;
        $customer->save();

        return redirect()->route('salesman.saved-customer')->with('success', 'Customer berhasil disimpan.');
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
        $request->validate([
            'progress' => 'nullable|string',
            'alasan' => 'nullable|string',
            // 'salesman_id' => 'nullable|integer',
            // 'sumber_data' => 'nullable|string',
            // 'nama' => 'required|string',
            // 'alamat' => 'nullable|string',
            // 'kelurahan' => 'nullable|string',
            // 'kecamatan' => 'nullable|string',
            // 'kota' => 'nullable|string',
            // 'tgl_lahir' => 'nullable|date',
            // 'jenis_kelamin' => 'nullable|string',
            // 'tipe_pelanggan' => 'nullable|string',
            // 'jenis_pelanggan' => 'nullable|string',
            // 'tenor' => 'nullable|integer',
            // 'tgl_gatepass' => 'nullable|date',
            // 'pekerjaan' => 'nullable|string',
            // 'jenis_kendaraan' => 'nullable|string',
            // 'nomor_rangka' => 'nullable|string',
            // 'no_telepon' => 'nullable|string',
            // 'no_telepon_update' => 'nullable|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->progress = $request->progress;
        $customer->alasan = $request->alasan;
        // $customer->salesman_id = $request->salesman_id;
        // $customer->sumber_data = $request->sumber_data;
        // $customer->nama = $request->nama;
        // $customer->alamat = $request->alamat;
        // $customer->kelurahan = $request->kelurahan;
        // $customer->kecamatan = $request->kecamatan;
        // $customer->kota = $request->kota;
        // $customer->tanggal_lahir = $request->tgl_lahir;
        // $customer->jenis_kelamin = $request->jenis_kelamin;
        // $customer->tipe_pelanggan = $request->tipe_pelanggan;
        // $customer->jenis_pelanggan = $request->jenis_pelanggan;
        // $customer->tenor = $request->tenor;
        // $customer->tanggal_gatepass = $request->tgl_gatepass;
        // $customer->pekerjaan = $request->pekerjaan;
        // $customer->model_mobil = $request->jenis_kendaraan;
        // $customer->nomor_rangka = $request->nomor_rangka;
        // $customer->nomor_hp_1 = $request->no_telepon;
        // $customer->nomor_hp_2 = $request->no_telepon_update;
        $customer->save();

        return redirect()->route('salesman.saved-customer')->with('updated', 'Data customer berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
