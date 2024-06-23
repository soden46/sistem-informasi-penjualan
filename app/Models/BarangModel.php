<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_barang',
        'id_kategori',
        'nama_barang',
        'bahan',
        'deskripsi',
        'jumlah',
        'harga',
        'foto',
        'finishing',
        'ukuran',
        'stok'
    ];
}
