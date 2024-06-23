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
        $transaksi = DB::table('penjualan as a')
            ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email', 'd.kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->get();
        $transaksic = DB::table('penjualan as a')
            ->select('a.*', 'b.id', 'b.nama_barang', 'b.jumlah', 'b.desain', 'b.keterangan', 'b.harga')
            ->join('custom_produk as b', 'a.id_custom', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->get();

        $results = [
            'pagetitle' => 'Data Penjualan',
            'transaksi' => $transaksi,
            'transaksic' => $transaksic
        ];
        return view('admin.pages.transaksi', $results);
    }

    public function laporanProduk()
    {
        $produk = DB::table('barang as a')
            ->select('a.*', 'b.kategori')
            ->join('kategori as b', 'a.id_kategori', '=', 'b.id')
            ->get();

        $url = '/download-laporan-produk';
        $results = [
            'pagetitle' => 'Data Produk',
            'produk' => $produk,
            'url' => $url,
        ];
        return view('admin.pages.laporan-produk', $results);
    }

    public function custom_product()
    {
        $custom = DB::table('custom_produk as a')
            ->select('a.*', 'b.id')
            ->join('users as b', 'a.id_user', '=', 'b.id')
            ->get();

        $url = '/download-laporan-custom-produk';
        $results = [
            'pagetitle' => 'Data Custom Produk',
            'custom' => $custom,
            'url' => $url,
        ];
        return view('admin.pages.laporan-custom', $results);
    }

    public function invoice($id)
    {
        $id_pelanggan = login()->id;
        $invoice = DB::table('penjualan as a')
            ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.stok', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email', 'd.kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id')
            ->where('a.id', '=', $id)->get()->first();
        $rekening = DB::table('rekening')->get();
        $results = [
            'pagetitle' => 'Invoice',
            'invoice' => $invoice,
            'rekening' => $rekening,
        ];
        return view('admin.pages.invoice', $results);
    }

    public function invoicec($id)
    {
        $id_pelanggan = login()->id;
        $invoicec = DB::table('penjualan as a')
            ->select('a.*', 'b.nama_barang', 'b.jumlah as per', 'b.desain', 'b.keterangan', 'b.harga', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email',)
            ->join('custom_produk as b', 'a.id_custom', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->where('a.id', '=', $id)->get()->first();
        $rekening = DB::table('rekening')->get();
        $results = [
            'pagetitle' => 'Invoice',
            'invoicec' => $invoicec,
            'rekening' => $rekening,
        ];
        return view('admin.pages.invoicec', $results);
    }

    public function update(Request $request, $id)
    {
        $id_barang = $request['id_barang'];

        $rules =  [
            'status' => 'required',
        ];
        if ($request->validate($rules)) {
            $results = [
                'status' => $request['status']
            ];
            if ($request['tgl_tersedia'] && $request['jam_selesai'] != null) {
                $date = $request['tgl_tersedia'];
                $selesai = $request['jam_selesai'];
                $tgl_tersedia = date('Y-m-d', strtotime($date));
                $jam_tersedia = date('H:i', strtotime($selesai . "+ 2 hours"));
                $status = [
                    'status' =>  $request['status_alat'],
                    'tgl_tersedia' => $tgl_tersedia,
                    'jam_tersedia' => $jam_tersedia
                ];
                TransaksiModel::where('id', $id)->update($results);
                BarangModel::where('id', $id_barang)->update($status);
                notify()->success('Status diperbarui', 'Berhasil');
                return back();
            } else if ($request['tgl_tersedia'] && $request['jam_selesai'] == null) {
                $date = $request['tgl_tersedia'];
                $tgl_tersedia = date('Y-m-d', strtotime($date));
                $status = [
                    'status' =>  $request['status_alat'],
                    'tgl_tersedia' => $tgl_tersedia,
                    'jam_tersedia' => null
                ];
                TransaksiModel::where('id', $id)->update($results);
                BarangModel::where('id', $id_barang)->update($status);
                notify()->success('Status diperbarui', 'Berhasil');
                return back();
            }
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function delete($id)
    {
        if ($id != "") {
            TransaksiModel::where('id', $id)->delete();
            notify()->success('Transaksi di Batalkan', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function download_invoice($id)
    {
        $invoice = DB::table('transaksi as a')
            ->select('a.*', 'b.kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.jumlah as per', 'jam_selesai', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
            ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->where('a.id', $id)
            ->get()->first();
        $data = [
            'invoice' =>  $invoice
        ];
        $pdf = Pdf::loadView('home.pages.pdf.invoice', $data)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "CVMBH_INV-0" . $invoice->id . ".pdf";
        return $pdf->download($name);
    }

    public function laporan()
    {
        if (!empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"]) && empty($_GET["kategori"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $getmonth = DB::table('penjualan as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.ukuran', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();

            $custom = DB::table('penjualan as a')
                ->select('a.*', 'b.id', 'b.nama_barang', 'b.jumlah', 'b.desain', 'b.keterangan', 'b.harga')
                ->join('custom_produk as b', 'a.id_custom', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();

            $transaksic = $custom;

            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari=' . $tanggal_mulai . '&tgl_sampai=' . $tanggal_sampai . '&kategori=';
        } elseif (!empty($_GET["kategori"]) && !empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $kategori = $_GET["kategori"];
            $getmonth = DB::table('penjualan as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.ukuran', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email', 'k.kategori')
                ->join('barang as b', 'a.id_barang', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->join('kategori as k', 'b.id_kategori', '=', 'k.id')
                ->where('k.kategori', '=', $kategori)
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();

            $custom = DB::table('penjualan as a')
                ->select('a.*', 'b.id', 'b.nama_barang', 'b.jumlah', 'b.desain', 'b.keterangan', 'b.harga')
                ->join('custom_produk as b', 'a.id_custom', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();

            $transaksic = $custom;
            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari=' . $tanggal_mulai . '&tgl_sampai=' . $tanggal_sampai . '&kategori=' . $kategori;
        } elseif (!empty($_GET["kategori"]) && empty($_GET["tgl_dari"]) && empty($_GET["tgl_sampai"])) {
            $kategori = $_GET["kategori"];
            $getmonth = DB::table('penjualan as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.ukuran', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email', 'k.kategori')
                ->join('barang as b', 'a.id_barang', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->join('kategori as k', 'b.id_kategori', '=', 'k.id')
                ->where('k.kategori', '=', $kategori)
                ->get();
            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari=&tgl_sampai=&kategori=' . $kategori;
        } else {
            $all = DB::table('penjualan as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->get();

            $custom = DB::table('penjualan as a')
                ->select('a.*', 'b.id', 'b.nama_barang', 'b.jumlah', 'b.desain', 'b.keterangan', 'b.harga')
                ->join('custom_produk as b', 'a.id_custom', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->get();

            $transaksic = $custom;
            $transaksi = $all;
            $url = '/download-laporan';
        }
        $kategori = DB::table('kategori')->get();
        $results = [
            'pagetitle' => 'Data Penjualan',
            'transaksi' => $transaksi,
            'transaksic' => $transaksic,
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
            $getmonth = DB::table('penjualan as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
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
            $getmonth = DB::table('penjualan as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
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
            $getmonth = DB::table('penjualan as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('b.id_kategori', '=', $kategori)
                ->get();
            $transaksi = $getmonth;
            $periode = 'All';
            $kategori = $kategori;
        }

        if (empty($_GET["kategori"]) && empty($_GET["tgl_dari"]) && empty($_GET["tgl_sampai"])) {
            $all = DB::table('penjualan as a')
                ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email')
                ->join('barang as b', 'a.id_barang', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
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
            ->select('a.*', 'b.kategori')
            ->join('kategori as b', 'a.id_kategori', '=', 'b.id')
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

    public function cetak_laporanCustom()
    {
        $all = DB::table('custom_produk as a')
            ->select('a.*', 'b.id')
            ->join('users as b', 'a.id_user', '=', 'b.id')
            ->get();

        $custom = $all;

        $results = [
            'pagetitle' => 'Data Custom Produk',
            'custom' => $custom,
        ];
        $pdf = Pdf::loadView('admin.pages.pdf.laporan-custom-product', $results)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "Laporan-Custom-Produk" . ".pdf";
        return $pdf->download('Laporan-Cutom-Produk' . $name);
    }

    public function cetak_laporanPengiriman()
    {
        $all = DB::table('penjualan as a')
            ->select('a.*', 'b.status', 'c.nama', 'c.alamat', 'c.email', 'c.no_hp', 'd.nama_barang')
            ->join('pengiriman as b', 'a.id_pengiriman', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->join('barang as d', 'a.id_barang', '=', 'c.id')
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
