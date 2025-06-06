<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\User;
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
        $datausers = User::count();
        $dataruangan = 0; // Ganti dengan model Ruangan jika ada
        $datapeminjaman = 0; // Ganti dengan model Peminjaman jika ada
        $datapengembalian = 0; // Ganti dengan model Pengembalian jika ada
        
        // Jika ada model Activity, tambahkan:
        // $activities = Activity::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'databarang',
            'datakategori',
            'datausers',
            'dataruangan',
            'datapeminjaman',
            'datapengembalian'
            // 'activities'
        ));
    }
}

