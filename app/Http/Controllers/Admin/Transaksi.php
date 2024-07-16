<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlatBeratModel;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify;

class Transaksi extends Controller
{
    public function index()
    {
        $transaksi = DB::table('pembelian as a')
            ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'a.id_id_kategori', '=', 'd.id_kategori')
            ->get();

        $results = [
            'pagetitle' => 'Data Penjualan',
            'transaksi' => $transaksi,
        ];
        return view('admin.pages.transaksi', $results);
    }

    public function laporanProduk()
    {
        $produk = DB::table('barang as a')
            ->select('a.*', 'b.nama_kategori')
            ->join('kategori as b', 'a.id_kategori', '=', 'b.id_kategori')
            ->get();

        $url = '/download-laporan-produk';
        $results = [
            'pagetitle' => 'Data Produk',
            'produk' => $produk,
            'url' => $url,
        ];
        return view('admin.pages.laporan-produk', $results);
    }

    public function invoice($id)
    {
        $id_pelanggan = login()->id;
        $invoice = DB::table('pembelian as a')
            ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pembelian', '=', $id)->first();
        $rekening = DB::table('metode_pembayaran')->get();
        $results = [
            'pagetitle' => 'Invoice',
            'invoice' => $invoice,
            'rekening' => $rekening,
        ];
        // dd($invoice);
        return view('admin.pages.invoice', $results);
    }

    public function update(Request $request, $id_pembelian)
    {
        $id_barang = $request['id_barang'];

        $rules =  [
            'status' => 'required',
        ];
        if ($request->validate($rules)) {
            $results = [
                'status' => $request['status']
            ];
            $status = [
                'status' =>  $request['status_alat'],
            ];
            TransaksiModel::where('id_pembelian', $id_pembelian)->update($results);
            return back()->with('message', 'Data berhasil disimpan!');;
        } else {
            return back()->with('message', 'Data gagal disimpan!');;
        }
    }

    public function pengiriman(Request $request, $id_pembelian)
    {
        $id_barang = $request['id_barang'];

        $rules =  [
            'status_pengiriman' => 'required',
        ];
        if ($request->validate($rules)) {
            $results = [
                'status_pengiriman' => $request['status_pengiriman']
            ];
            TransaksiModel::where('id_pembelian', $id_pembelian)->update($results);
            return back()->with('message', 'Data berhasil disimpan!');;
        } else {
            return back()->with('message', 'Data gagal disimpan!');;
        }
    }

    public function delete($id_pembelian)
    {
        if ($id_pembelian != "") {
            TransaksiModel::where('id_pembelian', $id_pembelian)->delete();
            return back()->with('message', 'Transaksi berhasil dibatalkan!');;
        } else {
            return back()->with('message', 'Transaksi gagal dibatalkan!');;
        }
    }

    public function download_invoice($id)
    {
        $invoice = DB::table('pembelian as a')
            ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pembelian', $id)
            ->get()->first();
        $data = [
            'invoice' =>  $invoice
        ];
        $pdf = Pdf::loadView('home.pages.pdf.invoice', $data)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "CVMBH_INV-0" . $invoice->id_pembelian . ".pdf";
        return $pdf->download($name);
    }

    public function laporan()
    {
        if (!empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"]) && empty($_GET["kategori"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $getmonth = DB::table('pembelian as a')
                ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
                ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
                ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();

            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari=' . $tanggal_mulai . '&tgl_sampai=' . $tanggal_sampai . '&kategori=';
        } elseif (!empty($_GET["kategori"]) && !empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $kategori = $_GET["kategori"];
            $getmonth = DB::table('pembelian as a')
                ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
                ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
                ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
                ->where('d.kategori', '=', $kategori)
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();

            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari=' . $tanggal_mulai . '&tgl_sampai=' . $tanggal_sampai . '&kategori=' . $kategori;
        } elseif (!empty($_GET["kategori"]) && empty($_GET["tgl_dari"]) && empty($_GET["tgl_sampai"])) {
            $kategori = $_GET["kategori"];
            $getmonth = DB::table('pembelian as a')
                ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
                ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
                ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
                ->where('k.kategori', '=', $kategori)
                ->get();

            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari=&tgl_sampai=&kategori=' . $kategori;
        } else {
            $all = DB::table('pembelian as a')
                ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
                ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
                ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
                ->get();

            $transaksi = $all;
            $url = '/download-laporan';
        }
        $kategori = DB::table('kategori')->get();
        $results = [
            'pagetitle' => 'Data Penjualan',
            'transaksi' => $transaksi,
            'kategori' => $kategori,
            'url' => $url,
        ];
        return view('admin.pages.laporan', $results);
    }

    public function cetak_laporan()
    {
        if (!empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"]) && empty($_GET["katgori"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $getmonth = DB::table('pembelian as a')
                ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email',)
                ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();

            $transaksi = $getmonth;
            $periode = $tanggal_mulai . ' s.d ' . $tanggal_sampai;
            $kategori = 'All';
        }

        if (!empty($_GET["kategori"]) && !empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $kategori = $_GET["kategori"];
            $getmonth = DB::table('pembelian as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
                ->where('b.id_kategori', '=', $kategori)
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();
            $transaksi = $getmonth;
            $periode = $tanggal_mulai . ' s.d ' . $tanggal_sampai;
            $kategori = $kategori;
        }

        if (!empty($_GET["kategori"]) && empty($_GET["tgl_dari"]) && empty($_GET["tgl_sampai"])) {
            $kategori = $_GET["kategori"];
            $getmonth = DB::table('pembelian as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
                ->where('b.id_kategori', '=', $kategori)
                ->get();
            $transaksi = $getmonth;
            $periode = 'All';
            $kategori = $kategori;
        }

        if (empty($_GET["kategori"]) && empty($_GET["tgl_dari"]) && empty($_GET["tgl_sampai"])) {
            $all = DB::table('pembelian as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
                ->get();

            $transaksi = $all;
            $periode = 'All';
            $kategori = 'All';
        }

        $results = [
            'pagetitle' => 'Data Penjualan',
            'transaksi' => $transaksi,
            'periode' => $periode,
            'kategori' => $kategori,
        ];
        $pdf = Pdf::loadView('admin.pages.pdf.laporan', $results)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "Laporan-" . $periode . "kategori-" . $kategori . ".pdf";
        return $pdf->download('Laporan-Penjualan' . $name);
    }

    public function cetak_laporanProduk()
    {
        $all = DB::table('barang as a')
            ->select('a.*', 'b.nama_kategori')
            ->join('kategori as b', 'a.id_kategori', '=', 'b.id_kategori')
            ->get();

        $produk = $all;

        $results = [
            'pagetitle' => 'Data Produk',
            'produk' => $produk,
        ];
        $pdf = Pdf::loadView('admin.pages.pdf.laporan-produk', $results)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "Laporan-Produk" . ".pdf";
        return $pdf->download('Laporan-Produk' . $name);
    }

    public function cetak_laporanPengiriman()
    {
        $all =
            DB::table('pembelian as a')
            ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->get();

        $kirim = $all;

        $results = [
            'pagetitle' => 'Data Pengiriman',
            'kirim' => $kirim,
        ];
        $pdf = Pdf::loadView('admin.pages.pdf.laporan-pengiriman', $results)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "Laporan-Pengiriman" . ".pdf";
        return $pdf->download('Laporan-Pengiriman' . $name);
    }
}
