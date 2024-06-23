<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify;

class Type extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori')->get();
        $results = [
            'pagetitle' => 'Data Kategori',
            'uri' => 'type mebel',
            'kategori' => $kategori,
        ];
        return view('admin.pages.kategori', $results);
    }

    public function create(Request $request)
    {

        $rules =  [
            'nama_kategori' => ['string', 'min:3', 'max:191', 'required', 'unique:nama_kategori'],
        ];
        if ($request->validate($rules)) {
            TypeModel::insert($request->validate($rules));
            notify()->success('Data telah ditambahkan', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function update(Request $request, $id_kategori)
    {
        $rules =  [
            'nama_kategori' => ['string', 'min:3', 'max:191', 'required'],
        ];

        if ($request->validate($rules)) {
            $kategori = DB::table('kategori')->where('nama_kategori', $request->nama_kategori)->first();
            if ($kategori = NULL && $request->nama_kategori != $kategori->nama_kategori) {
                $rules = [
                    'nama_kategori' => ['string', 'min:3', 'max:191', 'required', 'unique:nama_kategori'],
                ];
            } else {
                $validatedData = $request->validate($rules);
                $concat = $validatedData;
                TypeModel::where('id_kategori', $id_kategori)->update($concat);

                notify()->success('Data telah diperbarui', 'Berhasil');
                return back();
            }
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function delete($id_kategori)
    {
        if ($id_kategori != "") {
            TypeModel::where('id_kategori', $id_kategori)->delete();
            notify()->success('Data telah dihapus', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
