<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\Transaksi as AdminTransaksi;
use App\Http\Controllers\Controller;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify;


class Transaksi extends Controller
{
    public function index()
    {
        $id_pelanggan = login()->id_user;
        $transaksi = DB::table('pembelian as a')
            ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pelanggan', $id_pelanggan)->get();
        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
        ];
        return view('home.pages.transaksi', $results);
    }

    public function invoice($id_pembelian)
    {
        $id_pelanggan = login()->id;
        $invoice = DB::table('pembelian as a')
            ->select('a.*', 'b.id_kategori', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pembelian', '=', $id_pembelian)->get()->first();

        $rekening = DB::table('metode_pembayaran')->get();
        $results = [
            'pagetitle' => 'Invoice',
            'invoice' => $invoice,
            'rekening' => $rekening,
        ];
        return view('home.pages.invoice', $results);
    }

    public function create(Request $request)
    {
        // dd(login()->id_user);
        $rules =  [
            'id_barang' => ['string', 'required'],
            'lokasi_pengiriman' => ['string', 'max:191', 'required'],
            'jumlah' => ['string', 'max:191', 'required'],
        ];
        $request->validate($rules);
        $data = [
            'id_pelanggan' => login()->id_user,
            'id_barang' => $request['id_barang'],
            'total_barang' => $request['jumlah'],
            'total_harga' => $request['total'],
            'alamat_pengiriman' => $request['lokasi_pengiriman']
        ];
        TransaksiModel::insert($data);
        notify()->success('Pesanan Berhasil, Silahkan Melakukan Pembayaran', 'Berhasil');
        return redirect('transaksi');
    }

    public function update(Request $request, $id_pembelian)
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
                TransaksiModel::where('id_pembelian', $id_pembelian)->update($results);
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

    public function delete($id_pembelian)
    {
        if ($id_pembelian != "") {
            TransaksiModel::where('id_pembelian', $id_pembelian)->delete();
            notify()->success('Transaksi di Batalkan', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function download_invoice($id_pembelian)
    {
        $id_pelanggan = login()->id;
        $invoice = DB::table('pembelian as a')
            ->select('a.*', 'b.id_kategori', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pembelian', '=', $id_pembelian)->get()->first();
        $data = [
            'invoice' =>  $invoice
        ];
        $pdf = Pdf::loadView('home.pages.pdf.invoice', $data)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "CV_Amarta_INV-0" . $invoice->id_pembelian . ".pdf";
        return $pdf->download($name);
    }
}
