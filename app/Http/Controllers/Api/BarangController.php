<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|string',
            'barang_nama' => 'required|string',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->store('public/posts');
        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $image->hashName(),
        ]);

        if ($barang) {
            return response()->json([
                'barang_id' => $barang->barang_id,
                'kategori_id' => $barang->kategori_id,
                'barang_kode' => $barang->barang_kode,
                'barang_nama' => $barang->barang_nama,
                'harga_beli' => $barang->harga_beli,
                'harga_jual' => $barang->harga_jual,
                'created_at' => $barang->created_at,
                'updated_at' => $barang->updated_at,
                'image' => $barang->image,
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menyimpan data barang'
        ], 409);
    }

    public function show(BarangModel $barang)
    {
        return response()->json([
            'success' => true,
            'data' => $barang,
        ]);
    }

    public function destroy(BarangModel $barang)
    {
        if ($barang->image) {
            Storage::disk('public')->delete('barang/' . $barang->image);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus'
        ]);
    }
}
