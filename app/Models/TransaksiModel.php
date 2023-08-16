<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'id',
        'id_pelanggan',
        'id_barang',
        'id_pengiriman',
        'id_custom',
        'jumlah',
        'alamat_pengiriman',
        'status',
        'bukti_pembayaran',
    ];
}
