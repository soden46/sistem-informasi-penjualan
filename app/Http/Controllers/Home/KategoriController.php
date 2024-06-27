<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function show($id_kategori)
    {
        $kategori = KategoriModel::findOrFail($id_kategori);
        $barang = BarangModel::where('id_kategori', $id_kategori)->get();
        $results = [
            'pagetitle' => 'Kategori',
            'barang' => $barang,
            'kategori' => $kategori,
        ];
        return view('home.pages.kategori-detail', $results);
    }
}
