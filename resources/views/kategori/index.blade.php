@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kategori/import') }}')" class="btn btn-sm btn-primary mt-1">Import Kategori</button>
                {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/create') }}">Tambah</a> --}}
                <a href="{{ url('/kategori/export_excel') }}" class="btn btn-success btn-sm mt-1"><i class="fa fa-file-excel"></i> Export Kategori (xlsx)</a>
                <button onclick="modalAction('{{ url('/kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data backdrop="static"
    data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css') 
@endpush

@push('js')     
    <script>
        function modalAction(url = '') {
                $('#myModal').load(url, function () {
                    $('#myModal').modal('show');
                });
                }
                
            var dataKategori;
            $(document).ready(function () {
                dataKategori = $('#table_kategori').DataTable({
                    serverSide: true,
                    ajax: {
                        "url": "{{ url('kategori/list') }}",
                        "type": "POST",
                        "data": function (d) {
                            d._token = '{{ csrf_token() }}';
                        }
                    },
                    columns: [
                        {
                            // nomor urut dari laravel datatable addIndexColumn() 
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        }, {
                            data: "kategori_kode",
                            className: "",
                            orderable: true,
                            searchable: true
                        }, {
                            // mengambil data level hasil dari ORM berelasi 
                            data: "kategori_nama",
                            className: "",
                            orderable: false,
                            searchable: false
                        }, {
                            data: "aksi",
                            className: "",
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

            }); 
        </script>
@endpush