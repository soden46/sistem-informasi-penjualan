<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = [
        'id_kategori',
        'nama_kategori',
    ];
}
