<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomModel extends Model
{
    use HasFactory;

    protected $table = 'custom_produk';
    protected $fillable = [
        'id_user',
        'nama_barang',
        'jumlah',
        'desain',
        'keterangan',
        'harga',
        'created_at',
    ];
    const UPDATED_AT = null;
}
