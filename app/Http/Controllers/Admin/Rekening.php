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
        $rekening = DB::table('rekening')->get();
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
            'bank' => ['string', 'min:3', 'max:191', 'required'],
            'no_rekening' => ['string', 'min:3', 'max:191', 'required'],
            'nama_rekening' => ['string', 'min:3', 'max:191', 'required'],
        ];
        if ($request->validate($rules)) {
            RekeningModel::insert($request->validate($rules));
            notify()->success('Data telah ditambahkan', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $rules =  [
            'bank' => ['string', 'min:3', 'max:191', 'required'],
            'no_rekening' => ['string', 'min:3', 'max:191', 'required'],
            'nama_rekening' => ['string', 'min:3', 'max:191', 'required'],
        ];

        if ($request->validate($rules)) {

            $validatedData = $request->validate($rules);
            $concat = $validatedData;

            RekeningModel::where('id', $id)->update($concat);
            notify()->success('Data telah diperbarui', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function delete($id)
    {
        if ($id != "") {
            RekeningModel::where('id', $id)->delete();
            notify()->success('Data telah dihapus', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
