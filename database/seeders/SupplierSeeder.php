<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_kode' => 'SUP001', 'supplier_nama' => 'Maju Jaya', 'supplier_alamat' => 'Malang'],
            ['supplier_kode' => 'SUP002', 'supplier_nama' => 'Berkah Jaya', 'supplier_alamat' => 'Polinema'],
            ['supplier_kode' => 'SUP003', 'supplier_nama' => 'Barokah Jaya', 'supplier_alamat' => 'Suhat'],
        ];
        DB::table('m_supplier')->insert($data);  
    }
}
