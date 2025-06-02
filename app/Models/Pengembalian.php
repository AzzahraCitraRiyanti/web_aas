<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_pengembalian',
        'kondisi_barang',
        'catatan',
        'status',
        'nama_pengembali',
        'jumlah_kembali',
        'biaya_denda'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    /**
     * Get the user who made the return.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the barang (item) that was returned.
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

