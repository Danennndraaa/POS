<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Models\LevelModel;


class AuthController extends Controller
{
    public function login()
     {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth/login');
     }
 
     public function PostLogin(Request $request)
     {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');
 
            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            } 
             
            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }
        return redirect('login');
    }
 
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function register()
{
    $level = LevelModel::all(); // Ambil semua level dari database
    return view('auth.register', compact('level'));
}

public function PostRegister(Request $request)
{
    $request->validate([
        'username' => 'required',
        'nama' => 'required',
        'password' => 'required|min:5',
        'level_id' => 'required|exists:m_level,level_id' // Validasi level harus ada di tabel m_level
    ]);

    $user = new UserModel();
    $user->username = $request->username;
    $user->nama = $request->nama;
    $user->password = bcrypt($request->password);
    $user->level_id = $request->level_id;
    $user->save();

    return response()->json([
        'status' => true,  // Tambahkan status agar AJAX bisa membaca sukses
        'message' => 'Registrasi berhasil! Silakan login.',
        'redirect' => url('login') // Beri redirect yang bisa dibaca oleh AJAX
    ]);
}

}