<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profil()
    {
        $breadcrumb = (object) [
            'title' => 'Profile User',
            'list' => ['Home', 'Profile']
        ];

        $activeMenu = 'profil';
        $user = auth()->user(); // ambil user yang sedang login

        $profileImage = session('profile_image', 'default-profile.png');

        return view('profil', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'user' => $user,
            'profileImage' => $profileImage
        ]);
    }

    public function updateProfil(Request $request)
    {
        try {
            $request->validate([
                'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user = UserModel::find(Auth::id());

            if (!$user) return redirect()->back()->with('error', 'User tidak ditemukan.');

            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');
                $filename = 'profile-' . $user->user_id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/profile-photo', $filename);

                $user->profile_photo = $filename;
                $user->save();
            }


            return redirect()->back()->with('success', 'Foto profil berhasil diunggah.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Gagal mengunggah foto profil.');
        }
    }
}