<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = [
        'id',
        'id_kategori',
        'nama_barang',
        'bahan',
        'deskripsi',
        'jumlah',
        'harga',
        'gambar',
        'finishing',
        'ukuran',
        'stok'
    ];
}
