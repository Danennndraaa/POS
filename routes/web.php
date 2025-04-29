<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman Home
// Route::get('/', function () {
//     return view('welcome');
// });

Route::pattern('id', '[0-9]+'); // menambahkan constraint untuk parameter id, hanya menerima angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'PostLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'PostRegister']);

Route::middleware(['auth'])->group(function () {

    Route::get('/', [WelcomeController::class, 'index']);

    Route::group(['prefix' => 'user'], function () {
        Route::middleware(['authorize:ADM'])->group(function () {
            Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
            Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
            Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
            Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
            Route::get('/create_ajax', [UserController::class, 'create_ajax']);   // menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [UserController::class, 'store_ajax']);   // menyimpan data user baru Ajax
            Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
            Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
            Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
            Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);  // menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);     // menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi delete user ajax
            Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
            Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']); // menampilkan detail user ajax
            Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
            Route::get('/import', [UserController::class, 'import']); // menampilkan halaman form import user
            Route::post('/import_ajax', [UserController::class, 'import_ajax']); // menyimpan data user baru Ajax
            Route::get('/export_excel', [UserController::class, 'export_excel']); // menampilkan halaman form export user
            Route::get('/export_pdf', [UserController::class, 'export_pdf']); // menampilkan halaman form export user pdf
        });
    });

    Route::group(['prefix' => 'level'], function () {
        Route::middleware(['authorize:ADM'])->group(function () {
            Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal Level
            Route::post('/list', [LevelController::class, 'list']);      // menampilkan data Level dalam bentuk json untuk datatables
            Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah Level
            Route::post('/', [LevelController::class, 'store']);         // menyimpan data Level baru
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']);   // menampilkan halaman form tambah Level Ajax
            Route::post('/ajax', [LevelController::class, 'store_ajax']);   // menyimpan data Level baru Ajax
            Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail Level
            Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit Level
            Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data Level
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);  // menampilkan halaman form edit Level Ajax
            Route::put('ajax/{id}', [LevelController::class, 'update_ajax']);; // menyimpan perubahan data Level Ajax
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi delete Level ajax
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data Level ajax
            Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); // menampilkan detail Level ajax
            Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data Level
            Route::get('/import', [LevelController::class, 'import']); // menampilkan halaman form import level
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // menyimpan data level baru Ajax
            Route::get('/export_excel', [LevelController::class, 'export_excel']); // menampilkan halaman form export level
            Route::get('/export_pdf', [LevelController::class, 'export_pdf']); // menampilkan halaman form export Level pdf
        });
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
            Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
            Route::post('/list', [KategoriController::class, 'list']);      // menampilkan data kategori dalam bentuk json untuk datatables
            Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
            Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori baru
            Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);   // menampilkan halaman form tambah kategori Ajax
            Route::post('/ajax', [KategoriController::class, 'store_ajax']);   // menyimpan data kategori baru Ajax
            Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
            Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
            Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
            Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);  // menampilkan halaman form edit kategori Ajax
            Route::put('ajax/{id}', [KategoriController::class, 'update_ajax']);; // menyimpan perubahan data kategori Ajax
            Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi delete kategori ajax
            Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori ajax
            Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // menampilkan detail kategori ajax
            Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
            Route::get('/import', [KategoriController::class, 'import']); // menampilkan halaman form import kategori
            Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // menyimpan data kategori baru Ajax
            Route::get('/export_excel', [KategoriController::class, 'export_excel']); // menampilkan halaman form export kategori
            Route::get('/export_pdf', [KategoriController::class, 'export_pdf']); // menampilkan halaman form export kategori pdf
        });
    });

    Route::group(['prefix' => 'supplier'], function () {
        Route::middleware(['authorize:ADM,MNG'])->group(function () {
            Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
            Route::post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam bentuk json untuk datatables
            Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
            Route::post('/', [SupplierController::class, 'store']);         // menyimpan data supplier baru
            Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);   // menampilkan halaman form tambah supplier Ajax
            Route::post('/ajax', [SupplierController::class, 'store_ajax']);   // menyimpan data supplier baru Ajax
            Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
            Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
            Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
            Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // menampilkan halaman form edit supplier Ajax
            Route::put('ajax/{id}', [SupplierController::class, 'update_ajax']);; // menyimpan perubahan data supplier Ajax
            Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi delete supplier ajax
            Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data supplier ajax
            Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']); // menampilkan detail supplier ajax
            Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
            Route::get('/import', [SupplierController::class, 'import']); // menampilkan halaman form import supplier
            Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // menyimpan data supplier baru Ajax
            Route::get('/export_excel', [SupplierController::class, 'export_excel']); // menampilkan halaman form export supplier
            Route::get('/export_pdf', [SupplierController::class, 'export_pdf']); // menampilkan halaman form export supplier pdf
        });
    });

    //artinya semua route di dalam group ini harus punya role ADM dan MNG
    Route::group(['prefix' => 'barang'], function () {
        Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
            Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal supplier
            Route::post('/list', [BarangController::class, 'list']);      // menampilkan data supplier dalam bentuk json untuk datatables
            Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah supplier
            Route::post('/', [BarangController::class, 'store']);         // menyimpan data supplier baru
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah barang Ajax
            Route::post('/ajax', [BarangController::class, 'store_ajax']); // menyimpan data barang baru Ajax
            Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail supplier
            Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit supplier
            Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data supplier
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);  // menampilkan halaman form edit barang Ajax
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data barang Ajax
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // menampilkan halaman konfirmasi delete barang ajax
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);  // menghapus data barang ajax
            Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']); // menampilkan detail barang ajax
            Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data supplier
            Route::get('/import', [BarangController::class, 'import']); // menampilkan halaman form import barang
            Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // menyimpan data barang baru Ajax
            Route::get('/export_excel', [BarangController::class, 'export_excel']); // menampilkan halaman form export barang
            Route::get('/export_pdf', [BarangController::class, 'export_pdf']); // menampilkan halaman form export barang pdf
        });
    });

    Route::get('/profil', [ProfileController::class, 'profil'])->name('profil');
    Route::post('/profil', [ProfileController::class, 'updateProfil'])->name('profil.update');

    // Route::get('/level', [LevelController::class, 'index']);
    // Route::get('/kategori', [KategoriController::class, 'index']);
    // Route::get('/user', [UserController::class, 'index']);

    // Halaman Products
    Route::prefix('category')->group(function () {
        Route::get('/food-beverage', [ProductController::class, 'foodBeverage']);
        Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
        Route::get('/home-care', [ProductController::class, 'homeCare']);
        Route::get('/baby-kid', [ProductController::class, 'babyKid']);
    });


    Route::group(['prefix' => 'stok'], function () {
        Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
            Route::get('/', [StokController::class, 'index']);
            Route::post('/list', [StokController::class, 'list']);
            Route::get('/create_ajax', [StokController::class, 'create_ajax']);
            Route::post('/ajax', [StokController::class, 'store_ajax']);
            Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']);
            Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);
            Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);
            Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']);
            Route::get('import', [StokController::class, 'import']);
            Route::post('import_ajax', [StokController::class, 'import_ajax']);
            Route::get('export_excel', [StokController::class, 'export_excel']);
            Route::get('export_pdf', [StokController::class, 'export_pdf']);
        });
    });
});

Route::group(['prefix' => 'penjualan'], function () {
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
        Route::get('/', [PenjualanController::class, 'index']);
        Route::post('/list', [PenjualanController::class, 'list']);
        Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']);
        Route::post('/ajax', [PenjualanController::class, 'store_ajax']);
        Route::get('/{id}/show_ajax', [PenjualanController::class, 'show_ajax']);
        Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']);
        Route::get('import', [PenjualanController::class, 'import']);
        Route::post('import_ajax', [PenjualanController::class, 'import_ajax']);
        Route::get('export_excel', [PenjualanController::class, 'export_excel']);
        Route::get('export_pdf', [PenjualanController::class, 'export_pdf']);
    });
});

//Halaman user dengan route parameter
// Route::get('/user/{id}/name/{name}', [UserController::class, 'show']);

//Halaman Penjualan 
// Route::get('/penjualan', [PenjualanController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);