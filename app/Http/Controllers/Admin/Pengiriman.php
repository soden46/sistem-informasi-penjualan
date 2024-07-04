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

        $kirim = DB::table('pembelian as a')
            ->select('a.*', 'b.nama_barang', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'c.alamat')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->get();
        $url = '/download-laporan-pengiriman';
        $results = [
            'pagetitle' => 'Data Pengiriman',
            'kirim' => $kirim,
            'url' => $url
        ];
        return view('admin.pages.data-pengiriman', $results);
    }

    public function update(Request $request, $id_pembelian)
    {
        $id_barang = $request['id_barang'];

        $rules =  [
            'status_pengiriman' => 'required',
        ];
        if ($request->validate($rules)) {
            $results = [
                'status_pengiriman' => $request['status_pengiriman']
            ];
            $status = [
                'status_pengiriman' =>  $request['status_pengiriman'],
            ];
            TransaksiModel::where('id_pembelian', $id_pembelian)->update($results);
            notify()->success('Data telah diupdate', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function delete($id_pembelian)
    {
        if ($id_pembelian != "") {
            TransaksiModel::where('id_pembelian', $id_pembelian)->delete();
            notify()->success('Pengiriman di Batalkan', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
