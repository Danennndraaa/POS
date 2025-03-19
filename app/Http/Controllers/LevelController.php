<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {   
        
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar Level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';


        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
        

        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values (?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        // return 'insert data baru berhasil';

        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'update data berhasil. Jumlah data yang diupdate: ' .$row. ' baris';

        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'delete data berhasil. Jumlah data yang dihapus: ' .$row. ' baris';

        // $data = DB::select('select * from m_level');
        // return view('level', ['data' => $data]);
    }
    
    // Ambil data Level dalam bentuk json untuk datatables 
    public function list(Request $request) 
    { 
    $level = LevelModel::select('level_id', 'level_kode', 'level_nama'); 
 
    return DataTables::of($level) 
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addIndexColumn()  
        ->addColumn('aksi', function ($level) {  // menambahkan kolom aksi 
            // $btn  = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn sm">Detail</a> '; 
            // $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
            // $btn .= '<form class="d-inline-block" method="POST" action="'. url('/level/'.$level->level_id).'">' 
            //         . csrf_field() . method_field('DELETE') .  
            //         '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
            $btn  = '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
      
            return $btn; 
        }) 
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true); 
    } 

    // Menampilkan halaman form tambah level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Level Baru'
        ];
   
        $activeMenu = 'level';
        $level = LevelModel::all();

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu, 'level' => $level]);
    }

    // Menyimpan data level baru
    public function store(Request $request)
    {
        $request->validate([
    'level_kode' => 'required|max:3', 
    'level_nama' => 'required|string|max:50' // Validasi langsung level_nama
]);

LevelModel::create([
    'level_kode' => $request->level_kode,
    'level_nama' => $request->level_nama
]);


    return redirect('/level')->with('success', 'Data Level berhasil disimpan');
    }

    // Menampilkan detail Level
    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list'  => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'level' => $level]);
    }

    // Menampilkan halaman form edit level
    public function edit(string $id)
    {
        // Ambil data level berdasarkan ID
        $level = LevelModel::find($id);

        // Jika level tidak ditemukan, tampilkan halaman 404
        if (!$level) {
            abort(404, 'Level tidak ditemukan');
        }

        // Konfigurasi breadcrumb untuk navigasi
        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list'  => ['Home', 'Level', 'Edit']
        ];

        // Konfigurasi judul halaman
        $page = (object) [
            'title' => 'Edit level'
        ];
+
        // Menentukan menu yang sedang aktif
        $activeMenu = 'level';

        // Mengembalikan tampilan dengan data yang sudah dikonfigurasi
        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data level
    public function update(Request $request, string $id)
{
    // Validasi input dengan pengecualian untuk ID yang sedang diedit
    $request->validate([
        'level_kode' => 'required|string|max:3|unique:m_level,level_kode,' . $id . ',level_id',
        'level_nama' => 'required|string|max:100|unique:m_level,level_nama,' . $id . ',level_id',
    ]);

    // Update data
    LevelModel::where('level_id', $id)->update([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama,
    ]);

    return redirect('/level')->with('success', 'Data level berhasil diperbarui');
}

    // Menghapus data level
    public function destroy(string $id)
    {
        // Mengecek apakah data level dengan ID yang dimaksud ada atau tidak
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            // Menghapus data level berdasarkan ID
            LevelModel::destroy($id);

            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data,
            // redirect kembali ke halaman dengan pesan error
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // membuat ajax
    public function create_ajax()
    {
        $level = LevelModel::all();
        return view('level.create_ajax', ['level' => $level]);
    }

    // menyimpan data level baru ajax
    public function store_ajax(Request $request)
{
    $request->validate([
        'level_kode' => 'required|max:3|unique:m_level,level_kode',
        'level_nama' => 'required|max:50',
    ]);

    LevelModel::create([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama
    ]);

    return response()->json(['success' => 'Data Level berhasil disimpan']);
}
    //menampilkan halaman form edit user ajax
    public function edit_ajax(string $id)
{
    $level = LevelModel::find($id);

    if (!$level) {
        return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
    }

    return view('level.edit_ajax')->with('level', $level);
}
// menyimpan perubahan data level ajax
public function update_ajax(Request $request, $id)
{
    $request->validate([
        'level_kode' => 'required|max:3|unique:m_level,level_kode,' . $id . ',level_id',
        'level_nama' => 'required|max:50|unique:m_level,level_nama,' . $id . ',level_id',
    ]);

    $level = LevelModel::find($id);

    if (!$level) {
        return response()->json(['error' => 'Level tidak ditemukan'], 404);
    }

    $level->update([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama
    ]);

    return response()->json(['success' => 'Data Level berhasil diperbarui']);
}


// menampilkan halaman konfirmasi delete level ajax
public function confirm_ajax($id)
{
    $level = LevelModel::find($id);

    if (!$level) {
        return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
    }

    return view('level.confirm_ajax')->with('level', $level);
    }

    // menghapus data level ajax
    public function delete_ajax(Request $request, $id) 
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if (!$level) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
    
            try {
                $level->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'
                ]);
            }
        }
    
        return redirect('/');
    }

    // menampilkan detail level ajax
    public function show_ajax(string $id) {
        $level = LevelModel::find($id);

        return view('level.show_ajax', ['level' => $level]);
    }



}