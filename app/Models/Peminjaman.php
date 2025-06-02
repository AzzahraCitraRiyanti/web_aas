<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans'; // opsional, kalau nama tabel standar bisa dihapus

    protected $fillable = [
        'user_id',
        'barang_id',
        'alasan_pinjam',
        'tanggal_kembali',
        'tanggal_pinjam',
        'jumlah',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }
}
