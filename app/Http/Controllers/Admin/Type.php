<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify;
use Spatie\Image\Image;

class Type extends Controller
{
    public function index()
    {
        $barang = DB::table('barang')->get();
        $kategori = DB::table('kategori')->get();
        $results = [
            'pagetitle' => 'Data Kategori',
            'uri' => 'type mebel',
            'kategori' => $kategori,
            'barang' => $barang
        ];
        return view('admin.pages.kategori', $results);
    }

    public function create(Request $request)
    {
        $rules =  [
            'nama_kategori' => ['string', 'min:3', 'max:191', 'required'],
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];

        if ($request->validate($rules)) {
            $foto = $request->file('foto');

            // Simpan foto jika ada
            if ($foto) {
                $location = 'assets/upload/images/kategori/';
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

            // Simpan data ke database menggunakan model TypeModel
            TypeModel::insert($validatedData);

            return back()->with('message', 'Data berhasil disimpan!');
        } else {
            return back()->with('message', 'Data gagal disimpan!');
        }
    }

    public function update(Request $request, $id_kategori)
    {
        $rules = [
            'nama_kategori' => ['string', 'min:3', 'max:191', 'required'],
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];

        if ($request->validate($rules)) {
            $kategori = TypeModel::find($id_kategori);
            $foto = $request->file('foto');

            // Periksa apakah ada foto yang diunggah
            if ($foto) {
                // Jika ada foto yang diunggah, proses untuk menyimpan dan menghapus yang lama
                $location = 'assets/upload/images/kategori/';

                // Hapus foto lama jika ada
                if ($kategori->foto && file_exists($location . $kategori->foto)) {
                    unlink($location . $kategori->foto);
                }

                // Simpan foto baru
                $name = now()->timestamp . "_" . $foto->getClientOriginalName();
                Image::load($foto)
                    ->width(250)
                    ->height(250)
                    ->save($location . $name);

                // Update data kategori dengan foto baru
                $validatedData = $request->validate($rules);
                $validatedData['foto'] = $name;
            } else {
                // Jika tidak ada foto baru diunggah, hanya update data kategori tanpa mengubah foto
                $validatedData = $request->validate([
                    'nama_kategori' => ['string', 'min:3', 'max:191', 'required'],
                ]);

                // Periksa apakah kategori memiliki foto sebelumnya
                if ($kategori->foto) {
                    // Foto tidak diubah, gunakan foto yang sudah ada
                    $validatedData['foto'] = $kategori->foto;
                }
            }

            // Update data kategori dengan data terbaru
            TypeModel::where('id_kategori', $id_kategori)->update($validatedData);

            return back()->with('message', 'Data berhasil disimpan!');
        } else {
            return back()->with('message', 'Data gagal disimpan!');
        }
    }

    public function delete($id_kategori)
    {
        if ($id_kategori != "") {
            TypeModel::where('id_kategori', $id_kategori)->delete();
            return back()->with('message', 'Data berhasil dihapus!');;
        } else {
            return back()->with('message', 'Data gagal dihapus!');;
        }
    }
}
