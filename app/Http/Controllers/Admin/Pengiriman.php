<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlatBeratModel;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify;

class Pengiriman extends Controller
{
    public function index()
    {


        $kirim = DB::table('penjualan as a')
            ->select('a.*', 'b.nama_barang', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email', 'c.alamat', 'p.status')
            ->join('barang as b', 'a.id_barang', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->join('pengiriman as p', 'a.id_pengiriman', '=', 'p.id')
            ->get();
        $url = '/download-laporan-pengiriman';
        $results = [
            'pagetitle' => 'Data Pengiriman',
            'kirim' => $kirim,
            'url' => $url
        ];
        return view('admin.pages.data-pengiriman', $results);
    }
}
