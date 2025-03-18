@extends('layouts.template') 

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/level/' . $level->level_id) }}" class="form-horizontal">
                @csrf
                @method('PUT') <!-- Laravel directive untuk PUT -->

                <div class="form-group row">
                    <label for="level_kode" class="col-1 control-label col-form-label">Kode Level</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="level_kode" name="level_kode"
                            value="{{ old('level_kode', $level->level_kode) }}" required maxlength="3">
                        @error('level_kode') 
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror 
                    </div>
                </div>

                <div class="form-group row">
                    <label for="level_nama" class="col-1 control-label col-form-label">Level Nama</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="level_nama" name="level_nama"
                            value="{{ old('level_nama', $level->level_nama) }}" required>
                        @error('level_nama') 
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror 
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-11 offset-1">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection