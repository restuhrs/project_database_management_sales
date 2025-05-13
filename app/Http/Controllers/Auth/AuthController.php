<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.Login');  // Menampilkan halaman login
    }

    public function login(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil kredensial login dari input
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // Cek apakah user dengan username tersebut ada di model db_user
        $user = User::where('username', $request->username)->first();

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan user ke session Laravel
            Auth::login($user);
            $request->session()->regenerate(); // Regenerate session ID

            // Cek role pengguna dan arahkan ke halaman dashboard yang sesuai
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'kepala_cabang') {
                return redirect()->route('kacab.dashboard');
            } elseif ($user->role === 'supervisor') {
                return redirect()->route('supervisor.dashboard');
            } elseif ($user->role === 'salesman') {
                return redirect()->route('salesman.dashboard');
            } else {
                dd('Role tidak dikenali:', $user->role);
            }
        }

        // Jika login gagal, kirim pesan error dan arahkan kembali
        return redirect()->back()->withErrors(['error' => 'Username atau password salah']);  // Tampilkan error jika login gagal
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
