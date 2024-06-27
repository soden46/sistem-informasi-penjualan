<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $fillable = [
        'id_pembelian',
        'id_pelanggan',
        'id_barang',
        'jumlah',
        'alamat_pengiriman',
        'status',
        'bukti_pembayaran',
    ];
}
