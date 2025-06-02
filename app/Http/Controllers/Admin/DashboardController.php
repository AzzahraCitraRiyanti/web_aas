<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Konstruktor untuk middleware role
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan dashboard admin
    public function index()
    {
        $databarang = Barang::count();
        $datakategori = Kategori::count();
        return view('admin.dashboard', compact(['databarang','datakategori'] )); // Ganti dengan view yang sesuai
    }
}
