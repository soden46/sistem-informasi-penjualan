<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningModel extends Model
{
    use HasFactory;
    protected $table = 'rekening';
    protected $fillable = [
        'bank',
        'no_rekening',
        'nama_rekening',
    ];
}
