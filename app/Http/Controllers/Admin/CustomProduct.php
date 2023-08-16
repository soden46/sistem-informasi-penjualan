<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomProduct extends Controller
{
    public function index()
    {
        $custom = DB::table('custom_produk')->get();
        $user = DB::table('users')->get();
        $results = [
            'pagetitle' => 'Data Custom Produk',
            'uri' => 'admin',
            'custom' => $custom,
            'user' => $user,
        ];
        return view('admin.pages.data-custom-product', $results);
    }

    public function create(Request $request)
    {

        $rules =  [
            'nama_barang' => ['string', 'min:3', 'max:191', 'required'],
            'jumlah' => ['string', 'min:3', 'max:191', 'required'],
            'keterangan' => ['string', 'min:3', 'max:191', 'required'],
            'desain' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];
        if ($request->validate($rules)) {
            $desain = $request['desain'];
            $results_data = $request->validate($rules);
            if ($desain != "") {
                $name = now()->timestamp . "_{$desain->getClientOriginalName()}";
                $results =  [
                    'desain' => $name
                ];
                $concat = array_merge($results_data, $results);
                $location = 'assets/upload/images/custom/produk/';
                $desain->move($location, $name);
            } else {
                $validatedData = $results_data;
                $concat = $validatedData;
            }

            CustomModel::insert($concat);
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
            'harga' => ['string', 'min:3', 'max:191', 'required'],
        ];

        $validatedData = $request->validate($rules);
        CustomModel::where('id', $id)->update($validatedData);

        notify()->success('Data telah diperbarui', 'Berhasil');
        return back();
    }

    public function delete($id)
    {
        if ($id != "") {
            CustomModel::where('id', $id)->delete();
            notify()->success('Data telah dihapus', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
