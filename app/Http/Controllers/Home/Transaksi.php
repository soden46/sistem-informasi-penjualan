<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\Transaksi as AdminTransaksi;
use App\Http\Controllers\Controller;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Transaksi extends Controller
{
    public function index()
    {
        $id_pelanggan = login()->id;
        $transaksi = DB::table('penjualan as a')
            ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.ukuran', 'b.harga', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email', 'k.kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->join('kategori as k', 'b.id_kategori', '=', 'k.id')
            ->where('a.id_pelanggan', $id_pelanggan)->get();
        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
        ];
        return view('home.pages.transaksi', $results);
    }

    public function invoice($id)
    {
        $id_pelanggan = login()->id;
        $invoice = DB::table('penjualan as a')
            ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.stok', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email', 'd.kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id')
            ->where('a.id', '=', $id)
            ->where('a.id_pelanggan', '=', $id_pelanggan)->get()->first();
        $rekening = DB::table('rekening')->get();
        $results = [
            'pagetitle' => 'Invoice',
            'invoice' => $invoice,
            'rekening' => $rekening,
        ];
        return view('home.pages.invoice', $results);
    }

    public function invoicec($id)
    {
        $id_pelanggan = login()->id;
        $invoice = DB::table('penjualan as a')
            ->select('a.*', 'b.nama_barang', 'b.jumlah as per', 'b.desain', 'b.keterangan', 'b.harga', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email',)
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->where('a.id', '=', $id)
            ->where('a.id_pelanggan', '=', $id_pelanggan)->get()->first();
        $rekening = DB::table('rekening')->get();
        $results = [
            'pagetitle' => 'Invoice',
            'invoice' => $invoice,
            'rekening' => $rekening,
        ];
        return view('home.pages.invoice', $results);
    }

    public function create(Request $request)
    {
        $rules =  [
            'id_barang' => ['string', 'required'],
            'sku' => ['string', 'max:191', 'required'],
            'lokasi_pengiriman' => ['string', 'max:191', 'required'],
            'jumlah' => ['string', 'max:191', 'required'],
        ];
        $request->validate($rules);
        $data = [
            'id_pelanggan' => login()->id,
            'id_barang' => $request['id_barang'],
            'jumlah' => $request['jumlah'],
            'alamat_pengiriman' => $request['lokasi_pengiriman']
        ];
        TransaksiModel::insert($data);
        notify()->success('Pesanan Berhasil, Silahkan Melakukan Pembayaran', 'Berhasil');
        return redirect('transaksi');
    }

    public function update(Request $request, $id)
    {
        $rules =  [
            'bukti_pembayaran' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ];

        if ($request->validate($rules)) {
            $foto = $request['bukti_pembayaran'];
            if ($request->bukti_pembayaran != '') {
                $location = 'assets/upload/images/bukti_pembayaran/';
                $name = now()->timestamp . "_{$foto->getClientOriginalName()}";
                $results =  [
                    'bukti_pembayaran' => $name
                ];
                $foto->move($location, $name);
                TransaksiModel::where('id', $id)->update($results);
                notify()->success('Bukti Pembayaran Terkirim, Tunggu Konfirmasi Admin', 'Berhasil');
                return back();
            } else {
                notify()->warning('Harap Periksa Kembali', 'Gagal');
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
        $id_pelanggan = login()->id;
        $invoice = DB::table('penjualan as a')
            ->select('a.*', 'b.id_kategori', 'b.nama_barang', 'b.bahan', 'b.deskripsi', 'b.harga', 'b.stok', 'b.jumlah as per', 'c.nama as nama_pelanggan', 'c.no_hp', 'c.email', 'd.id', 'd.kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id')
            ->where('a.id', '=', $id)
            ->where('a.id_pelanggan', '=', $id_pelanggan)->get()->first();
        $data = [
            'invoice' =>  $invoice
        ];
        $pdf = Pdf::loadView('home.pages.pdf.invoice', $data)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "CV_Amarta_INV-0" . $invoice->id . ".pdf";
        return $pdf->download($name);
    }
}
