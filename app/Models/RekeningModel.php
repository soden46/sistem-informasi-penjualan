<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningModel extends Model
{
    use HasFactory;
    protected $table = 'metode_pembayaran';
    protected $primaryKey = 'id_metode_pembayaran';
    protected $fillable = [
        'nama_bank',
        'nomor_rekening',
        'nama_akun',
    ];
}
