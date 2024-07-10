<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekeningModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify;

class Rekening extends Controller
{
    public function index()
    {
        $rekening = DB::table('metode_pembayaran')->get();
        $results = [
            'pagetitle' => 'Data Rekening',
            'uri' => 'rekening',
            'rekening' => $rekening,
        ];
        return view('admin.pages.rekening', $results);
    }

    public function create(Request $request)
    {

        $rules =  [
            'nama_bank' => ['string', 'min:3', 'max:191', 'required'],
            'nomor_rekening' => ['string', 'min:3', 'max:191', 'required'],
            'nama_akun' => ['string', 'min:3', 'max:191', 'required'],
        ];
        if ($request->validate($rules)) {
            RekeningModel::insert($request->validate($rules));
            return back()->with('message', 'Data berhasil disimpan!');;
        } else {
            return back()->with('message', 'Data gagal disimpan!');;
        }
    }

    public function update(Request $request, $id_metode_pembayaran)
    {
        $rules =  [
            'nama_bank' => ['string', 'min:3', 'max:191', 'required'],
            'nomor_rekening' => ['string', 'min:3', 'max:191', 'required'],
            'nama_akun' => ['string', 'min:3', 'max:191', 'required'],
        ];

        if ($request->validate($rules)) {

            $validatedData = $request->validate($rules);
            $concat = $validatedData;

            RekeningModel::where('id_metode_pembayaran', $id_metode_pembayaran)->update($concat);
            return back()->with('message', 'Data berhasil disimpan!');;
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function delete($id_metode_pembayaran)
    {
        if ($id_metode_pembayaran != "") {
            RekeningModel::where('id_metode_pembayaran', $id_metode_pembayaran)->delete();
            return back()->with('message', 'Data berhasil dihapus!');;
        } else {
            return back()->with('message', 'Data gagal dihapus!');;
        }
    }
}
