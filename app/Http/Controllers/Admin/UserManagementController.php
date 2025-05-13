<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();

        $users = User::with('branch')->get();

        return view('Admin.UserManagement.UserManagement', compact('users' ,'branches'));
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
        $validated = $request->validate([
            'branch_id'=> 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user,username',
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role'     => 'required|string',
            'status'   => 'required|string',
            // 'email'   => 'required|string',
        ]);

        // Simpan data ke database
        $user = User::create([
            'branch_id'=> $validated['branch_id'],
            'username' => $validated['username'],
            'name'     => $validated['name'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
            'status'   => $validated['status'],
            // 'email'   => $validated['email'],
        ]);

        return redirect()->route('admin.usermanagement')->with('success', 'User berhasil ditambahkan!');
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
        $user = User::findOrFail($id);

        $request->validate([
            'branch_id' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:user,username,' . $user->id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'role' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $user->branch_id = Branch::where('name', $request->branch_id)->value('id');
        $user->username = $request->username;
        $user->name = $request->name;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.usermanagement')->with('updated', 'Data user berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id); // Temukan user berdasarkan ID atau gagal jika tidak ditemukan

        $user->delete(); // Hapus user dari database

        return redirect()->route('admin.usermanagement')->with('deleted', 'User berhasil dihapus');
    }
}
