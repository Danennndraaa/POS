@extends('layouts.template')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Hai, <strong>{{ Auth::user()->username }}</strong></h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            Selamat datang! <strong>{{ Auth::user()->nama }}</strong>, ini adalah halaman utama dari aplikasi ini.
        </div>
    </div>

@endsection