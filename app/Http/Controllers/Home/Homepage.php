<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Notify;

class Homepage extends Controller
{
    public function index()
    {
        $barang = DB::table('barang')->get();
        $kategori = DB::table('kategori')->get();
        $pelanggan = DB::table('users')->where('role', 'pelanggan')->get();
        $results = [
            'pagetitle' => 'Homepage',
            'barang' => $barang,
            'pelanggan' => $pelanggan,
            'kategori' => $kategori,
        ];


        return view('home.pages.homepage', $results);
    }

    public function detail($id_barang)
    {
        $barang = DB::table('barang as a')
            ->select('a.id_barang', 'a.id_kategori', 'a.nama_barang', 'a.stok', 'a.satuan', 'a.harga', 'a.foto', 'a.deskripsi')
            ->where('a.id_barang', '=', $id_barang)
            ->get()->first();
        $kategori = DB::table('kategori as k')
            ->select('k.id_kategori', 'k.nama_kategori', 'a.id_barang', 'a.id_kategori')
            ->join('barang as a', 'k.id_kategori', '=', 'a.id_kategori')
            ->where('a.id_barang', '=', $id_barang)
            ->get()->first();
        $results = [
            'pagetitle' => 'Detail Produk',
            'barang' => $barang,
            'kategori' => $kategori
        ];

        return view('home.pages.detail', $results);
    }

    public function faqs()
    {

        $results = [
            'pagetitle' => 'Tentang Kami',
        ];

        return view('home.pages.about', $results);
    }

    public function cara()
    {
        $results = [
            'pagetitle' => 'Cara Pemesanan',
        ];
        return view('home.pages.faqs', $results);
    }

    public function barang()
    {

        $barang = DB::table('barang')->get();
        $kategori = DB::table('kategori')->get();
        $results = [
            'pagetitle' => 'Furniture',
            'barang' => $barang,
            'kategori' => $kategori,
        ];

        return view('home.pages.barang', $results);
    }

    public function profile()
    {

        $results = [
            'pagetitle' => 'Profile',
        ];

        return view('home.pages.profile', $results);
    }
}
