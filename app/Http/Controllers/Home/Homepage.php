<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Homepage extends Controller
{
    public function index()
    {

        $profile = DB::table('settings')->get()->first();
        $barang = DB::table('barang')->get();
        $pelanggan = DB::table('users')->where('role', 'pelanggan')->get();
        $transaksi = DB::table('penjualan as a')->where('status', '1')->get();
        $results = [
            'pagetitle' => 'Homepage',
            'profile' => $profile,
            'barang' => $barang,
            'pelanggan' => $pelanggan,
            'transaksi' => $transaksi,
        ];

        return view('home.pages.homepage', $results);
    }

    public function detail($id)
    {

        $barang = DB::table('barang as a')
            ->select('a.id', 'a.id_kategori', 'a.nama_barang', 'a.bahan', 'a.deskripsi', 'a.jumlah', 'a.harga', 'a.gambar', 'a.finishing', 'a.ukuran', 'a.stok')
            ->where('a.id', '=', $id)
            ->get()->first();
        $kategori = DB::table('kategori as k')
            ->select('k.id', 'k.kategori', 'a.id', 'a.id_kategori')
            ->join('barang as a', 'k.id', '=', 'a.id_kategori')
            ->where('a.id', '=', $id)
            ->get()->first();
        $profile = DB::table('settings')->get()->first();
        $results = [
            'pagetitle' => 'Detail Produk',
            'profile' => $profile,
            'barang' => $barang,
            'kategori' => $kategori
        ];

        return view('home.pages.detail', $results);
    }

    public function faqs()
    {

        $profile = DB::table('settings')->get()->first();
        $results = [
            'pagetitle' => 'Tentang Kami',
            'profile' => $profile,
        ];

        return view('home.pages.about', $results);
    }

    public function custom_produk()
    {

        $profile = DB::table('settings')->get()->first();
        $results = [
            'pagetitle' => 'Custom Produk',
            'profile' => $profile,
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

        $profile = DB::table('settings')->get()->first();
        $barang = DB::table('barang')->get();

        $results = [
            'pagetitle' => 'Furniture',
            'profile' => $profile,
            'barang' => $barang,
        ];

        return view('home.pages.barang', $results);
    }

    public function profile()
    {

        $profile = DB::table('settings')->get()->first();

        $results = [
            'pagetitle' => 'Profile',
            'profile' => $profile,
        ];

        return view('home.pages.profile', $results);
    }
}
