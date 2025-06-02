<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangApiController extends Controller
{
    // Menampilkan semua barang
    public function index()
    {
        $barang = Barang::all();

        return response()->json([
            'status' => true,
            'message' => 'Data barang berhasil diambil',
            'data' => $barang
        ], 200);
    }

    // Menampilkan detail satu barang
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail barang',
            'data' => $barang
        ]);
    }

    // Menampilkan stok barang
    public function checkStock($id)
    {
        $barang = Barang::find($id);
        
        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }
        
        $stock = \App\Models\StockBarang::where('barang_id', $id)->first();
        $stokTersedia = $stock ? $stock->jumlah : 0;
        
        return response()->json([
            'status' => true,
            'message' => 'Informasi stok barang',
            'data' => [
                'barang' => $barang,
                'stok_tersedia' => $stokTersedia
            ]
        ]);
    }
}