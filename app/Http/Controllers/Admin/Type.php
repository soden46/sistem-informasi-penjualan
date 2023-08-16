<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Type extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori')->get();
        $results = [
            'pagetitle' => 'Data Kategori',
            'uri' => 'type alat-berat',
            'kategori' => $kategori,
        ];
        return view('admin.pages.kategori', $results);
    }

    public function create(Request $request)
    {

        $rules =  [
            'kategori' => ['string', 'min:3', 'max:191', 'required', 'unique:kategori'],
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

    public function update(Request $request, $id)
    {
        $rules =  [
            'kategori' => ['string', 'min:3', 'max:191', 'required'],
        ];

        if ($request->validate($rules)) {
            $kategori = DB::table('kategori')->where('kategori', $request->kategori)->first();
            if ($kategori = NULL && $request->kategori != $kategori->kategori) {
                $rules = [
                    'kategori' => ['string', 'min:3', 'max:191', 'required', 'unique:kategori'],
                ];
            } else {
                $validatedData = $request->validate($rules);
                $concat = $validatedData;
                TypeModel::where('id', $id)->update($concat);

                notify()->success('Data telah diperbarui', 'Berhasil');
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
            TypeModel::where('id', $id)->delete();
            notify()->success('Data telah dihapus', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
