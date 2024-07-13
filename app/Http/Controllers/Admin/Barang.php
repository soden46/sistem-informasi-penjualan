<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify;
use Spatie\Image\Image;

class Barang extends Controller
{
    public function index()
    {
        $barang = DB::table('barang as a')
            ->select('a.*', 'b.id_kategori', 'b.nama_kategori')
            ->join('kategori as b', 'a.id_kategori', '=', 'b.id_kategori')
            ->get();

        $kategori = DB::table('kategori')->get();

        $results = [
            'pagetitle' => 'Data Produk',
            'uri' => 'admin',
            'barang' => $barang,
            'kategori' => $kategori,
        ];
        return view('admin.pages.barang', $results);
    }

    public function create(Request $request)
    {
        $rules =  [
            'id_kategori' => ['string', 'required'],
            'nama_barang' => ['string', 'min:3', 'max:191', 'required'],
            'deskripsi' => ['string', 'min:3', 'max:191', 'required'],
            'stok' => ['string', 'required'],
            'satuan' => ['string', 'required'],
            'harga' => ['string', 'required'],
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];

        if ($request->validate($rules)) {
            $foto = $request->file('foto');

            // Simpan foto jika ada
            if ($foto) {
                $location = 'assets/upload/images/barang/';
                $name = now()->timestamp . "_" . $foto->getClientOriginalName();

                // Resize dan simpan foto menggunakan Spatie Image
                Image::load($foto)
                    ->width(250)
                    ->height(250)
                    ->save($location . $name);

                // Persiapkan data untuk disimpan ke database
                $validatedData = $request->validate($rules);
                $validatedData['foto'] = $name;
            } else {
                // Jika tidak ada foto diupload, gunakan data tanpa foto
                $validatedData = $request->validate($rules);
            }

            // Simpan data ke database menggunakan model BarangModel
            BarangModel::insert($validatedData);

            return back()->with('message', 'Data berhasil disimpan!');
        } else {
            return back()->with('message', 'Data gagal disimpan, periksa kembali!');
        }
    }

    public function update(Request $request, $id_barang)
    {
        $rules =  [
            'id_kategori' => ['string', 'nullable'],
            'nama_barang' => ['string', 'min:3', 'max:191', 'nullable'],
            'deskripsi' => ['string', 'min:3', 'max:191', 'nullable'],
            'stok' => ['string', 'nullable'],
            'satuan' => ['string', 'nullable'],
            'harga' => ['string', 'nullable'],
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];

        if ($request->validate($rules)) {
            $barang = BarangModel::where('id_barang', $id_barang)->first();
            $foto = $request->file('foto');

            if ($foto) {
                // Hapus foto lama jika ada
                $location = 'assets/upload/images/barang/';
                if ($barang->foto && file_exists($location . $barang->foto)) {
                    unlink($location . $barang->foto);
                }

                // Generate nama unik untuk foto baru
                $name = now()->timestamp . "_" . $foto->getClientOriginalName();

                // Resize dan simpan foto menggunakan Spatie Image
                Image::load($foto)
                    ->width(250)
                    ->height(250)
                    ->save($location . $name);

                // Update data barang dengan foto baru
                $validatedData = $request->validate($rules);
                $validatedData['foto'] = $name;
                BarangModel::where('id_barang', $id_barang)->update($validatedData);
            } else {
                // Jika tidak ada foto baru diupload, hanya update data barang
                $validatedData = $request->validate($rules);
                unset($validatedData['foto']); // Hapus aturan validasi foto jika tidak ada foto baru diupload
                BarangModel::where('id_barang', $id_barang)->update($validatedData);
            }

            return back()->with('message', 'Data berhasil diperbaharui!');
        } else {
            return back()->with('message', 'Data gagal diperbaharui!');
        }
    }


    public function delete($id_barang)
    {
        if ($id_barang != "") {
            BarangModel::where('id_barang', $id_barang)->delete();
            return back()->with('message', 'Data berhasil dihapus!');;
        } else {
            return back()->with('message', 'Data gagal dihapus!');;
        }
    }
}
