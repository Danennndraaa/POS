@extends('layouts.template') 

@section('content') 
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Level</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('level') }}" class="form-horizontal">
                @csrf

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Level Nama</label>
                    <div class="col-11">
                        <select class="form-control" id="level_id" name="level_id" required>
                            <option value="">- Pilih Level -</option>
                            @foreach($level as $item) 
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach 
                        </select>
                        @error('level_id') 
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror 
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Level Kode</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="level_kode" name="level_kode"
                            value="{{ old('level_kode') }}" required>
                        @error('level_kode') 
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror 
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection