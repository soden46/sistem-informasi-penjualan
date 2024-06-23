<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Barang extends Controller
{
    public function index()
    {
        $barang = DB::table('barang as a')
            ->select('a.*', 'b.id', 'b.kategori')
            ->join('kategori as b', 'a.id_kategori', '=', 'b.id')
            ->get();

        $results = [
            'pagetitle' => 'Data Produk',
            'uri' => 'admin',
            'barang' => $barang,
        ];
        return view('admin.pages.barang', $results);
    }

    public function create(Request $request)
    {

        $rules =  [
            'kategori' => ['string', 'min:3', 'max:191', 'required'],
            'sku' => ['string', 'min:3', 'max:191', 'required'],
            'bahan' => ['string', 'min:3', 'max:191', 'required'],
            'deskripsi' => ['string', 'min:3', 'max:191', 'required'],
            'harga' => ['string', 'min:3', 'max:191', 'required'],
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];
        if ($request->validate($rules)) {
            $foto = $request['foto'];
            $results_data = $request->validate($rules);
            if ($foto != "") {
                $name = now()->timestamp . "_{$foto->getClientOriginalName()}";
                $results =  [
                    'foto' => $name
                ];
                $concat = array_merge($results_data, $results);
                $location = 'assets/upload/images/barang/';
                $foto->move($location, $name);
            } else {
                $validatedData = $results_data;
                $concat = $validatedData;
            }

            BarangModel::insert($concat);
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
            'sku' => ['string', 'min:3', 'max:191', 'required'],
            'bahan' => ['string', 'min:3', 'max:191', 'required'],
            'deskripsi' => ['string', 'min:3', 'max:191', 'required'],
            'harga' => ['string', 'min:3', 'max:191', 'required'],
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];

        if ($request->validate($rules)) {
            $barang = BarangModel::find($id);
            $foto = $request['foto'];

            if ($request->foto != '') {

                $location = 'assets/upload/images/barang/';
                if ($barang->foto != ''  && $barang->foto != null) {
                    $file_old = $location . $barang->foto;
                    unlink($file_old);
                }
                $name = now()->timestamp . "_{$foto->getClientOriginalName()}";
                $results =  [
                    'foto' => $name
                ];
                $validatedData = $request->validate($rules);
                $concat = array_merge($validatedData, $results);
                $foto->move($location, $name);
            } else {
                $validatedData = $request->validate($rules);
                $concat = $validatedData;
            }
            BarangModel::where('id', $id)->update($concat);

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
            BarangModel::where('id', $id)->delete();
            notify()->success('Data telah dihapus', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
