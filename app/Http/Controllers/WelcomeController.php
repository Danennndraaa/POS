<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        $profileImage = session('profile_image', 'default-profile.png');

        return view('welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'profileImage' => $profileImage]);
    } 
}