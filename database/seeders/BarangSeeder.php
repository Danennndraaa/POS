<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Esteh', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG002', 'barang_nama' => 'Es Jeruk', 'harga_beli' => 20000, 'harga_jual' => 25000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG003', 'barang_nama' => 'Soda Gembira', 'harga_beli' => 30000, 'harga_jual' => 35000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG004', 'barang_nama' => 'Nasi Goreng', 'harga_beli' => 40000, 'harga_jual' => 45000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG005', 'barang_nama' => 'Ayam Goreng', 'harga_beli' => 50000, 'harga_jual' => 55000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG006', 'barang_nama' => 'Steak', 'harga_beli' => 60000, 'harga_jual' => 65000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG007', 'barang_nama' => 'Panci', 'harga_beli' => 70000, 'harga_jual' => 75000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG008', 'barang_nama' => 'Wajan', 'harga_beli' => 80000, 'harga_jual' => 85000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG009', 'barang_nama' => 'Telenan', 'harga_beli' => 90000, 'harga_jual' => 95000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG010', 'barang_nama' => 'Topi', 'harga_beli' => 100000, 'harga_jual' => 105000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG011', 'barang_nama' => 'Celana', 'harga_beli' => 110000, 'harga_jual' => 115000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG012', 'barang_nama' => 'Kaos', 'harga_beli' => 120000, 'harga_jual' => 125000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG013', 'barang_nama' => 'Remote', 'harga_beli' => 130000, 'harga_jual' => 135000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG014', 'barang_nama' => 'Antena TV', 'harga_beli' => 140000, 'harga_jual' => 145000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG015', 'barang_nama' => 'Kipas Angin', 'harga_beli' => 150000, 'harga_jual' => 155000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
