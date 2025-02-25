<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'barang_id' => 1, 'harga' => 15000, 'jumlah' => 2], // Esteh
            ['penjualan_id' => 1, 'barang_id' => 2, 'harga' => 25000, 'jumlah' => 1], // Es Jeruk
            ['penjualan_id' => 1, 'barang_id' => 3, 'harga' => 35000, 'jumlah' => 3], // Soda Gembira
            ['penjualan_id' => 2, 'barang_id' => 4, 'harga' => 45000, 'jumlah' => 2], // Nasi Goreng
            ['penjualan_id' => 2, 'barang_id' => 5, 'harga' => 55000, 'jumlah' => 1], // Ayam Goreng
            ['penjualan_id' => 2, 'barang_id' => 6, 'harga' => 65000, 'jumlah' => 2], // Steak
            ['penjualan_id' => 3, 'barang_id' => 7, 'harga' => 75000, 'jumlah' => 1], // Panci
            ['penjualan_id' => 3, 'barang_id' => 8, 'harga' => 85000, 'jumlah' => 2], // Wajan
            ['penjualan_id' => 3, 'barang_id' => 9, 'harga' => 95000, 'jumlah' => 3], // Telenan
            ['penjualan_id' => 4, 'barang_id' => 10, 'harga' => 105000, 'jumlah' => 1], // Topi
            ['penjualan_id' => 4, 'barang_id' => 11, 'harga' => 115000, 'jumlah' => 2], // Celana
            ['penjualan_id' => 4, 'barang_id' => 12, 'harga' => 125000, 'jumlah' => 2], // Kaos
            ['penjualan_id' => 5, 'barang_id' => 13, 'harga' => 135000, 'jumlah' => 1], // Remote
            ['penjualan_id' => 5, 'barang_id' => 14, 'harga' => 145000, 'jumlah' => 2], // Antena TV
            ['penjualan_id' => 5, 'barang_id' => 15, 'harga' => 155000, 'jumlah' => 3], // Kipas Angin
            ['penjualan_id' => 6, 'barang_id' => 1, 'harga' => 15000, 'jumlah' => 2], // Esteh
            ['penjualan_id' => 6, 'barang_id' => 3, 'harga' => 35000, 'jumlah' => 1], // Soda Gembira
            ['penjualan_id' => 6, 'barang_id' => 5, 'harga' => 55000, 'jumlah' => 2], // Ayam Goreng
            ['penjualan_id' => 7, 'barang_id' => 7, 'harga' => 75000, 'jumlah' => 1], // Panci
            ['penjualan_id' => 7, 'barang_id' => 9, 'harga' => 95000, 'jumlah' => 3], // Telenan
            ['penjualan_id' => 7, 'barang_id' => 11, 'harga' => 115000, 'jumlah' => 2], // Celana
            ['penjualan_id' => 8, 'barang_id' => 13, 'harga' => 135000, 'jumlah' => 1], // Remote
            ['penjualan_id' => 8, 'barang_id' => 2, 'harga' => 25000, 'jumlah' => 2], // Es Jeruk
            ['penjualan_id' => 8, 'barang_id' => 4, 'harga' => 45000, 'jumlah' => 1], // Nasi Goreng
            ['penjualan_id' => 9, 'barang_id' => 6, 'harga' => 65000, 'jumlah' => 2], // Steak
            ['penjualan_id' => 9, 'barang_id' => 8, 'harga' => 85000, 'jumlah' => 1], // Wajan
            ['penjualan_id' => 9, 'barang_id' => 10, 'harga' => 105000, 'jumlah' => 3], // Topi
            ['penjualan_id' => 10, 'barang_id' => 12, 'harga' => 125000, 'jumlah' => 2], // Kaos
            ['penjualan_id' => 10, 'barang_id' => 14, 'harga' => 145000, 'jumlah' => 1], // Antena TV
            ['penjualan_id' => 10, 'barang_id' => 15, 'harga' => 155000, 'jumlah' => 3], // Kipas Angin
        ];
        DB::table('t_penjualan_detail')->insert($data);
        
    }
}
