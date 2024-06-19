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
        $pelanggan = DB::table('users')->where('role', 'pelanggan')->get();
        $results = [
            'pagetitle' => 'Homepage',
            'barang' => $barang,
            'pelanggan' => $pelanggan,
        ];


        return view('home.pages.homepage', $results);
    }

    public function detail($id)
    {

        $barang = DB::table('barang as a')
            ->select('a.id', 'a.id_kategori', 'a.nama_barang', 'a.stok', 'a.satuan')
            ->where('a.id', '=', $id)
            ->get()->first();
        $kategori = DB::table('kategori as k')
            ->select('k.id', 'k.kategori', 'a.id', 'a.id_kategori')
            ->join('barang as a', 'k.id', '=', 'a.id_kategori')
            ->where('a.id', '=', $id)
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

    public function custom_produk()
    {
        $results = [
            'pagetitle' => 'Custom Produk',
        ];

        return view('home.pages.custom-produk', $results);
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

        $results = [
            'pagetitle' => 'Furniture',
            'barang' => $barang,
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
