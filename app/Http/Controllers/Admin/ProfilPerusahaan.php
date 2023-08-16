<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilPerusahaan extends Controller
{
    public function index(Request $request)
    {
        $profil_perusahaan = DB::table('settings')->get()->first();
        $results = [
            'pagetitle' => 'Profil Perusahaan',
            'uri' =>  $request->segments('1'),
            'profil' => $profil_perusahaan,
        ];
        return view('admin.pages.profil-perusahaan', $results);
    }


    public function update(Request $request, $id)
    {
        $rules =  [
            'nama_perusahaan' => ['string', 'min:3', 'max:191', 'required'],
            'tentang' => ['string', 'min:3', 'required'],
            'alamat' => ['string', 'min:3', 'max:191', 'required'],
            'telepon' => ['string', 'min:3', 'max:191', 'required'],
            'email' => ['string', 'email', 'min:3', 'max:191', 'required'],
            'facebook' => ['string', 'min:3', 'max:191', 'required'],
            'instagram' => ['string', 'min:3', 'max:191', 'required'],
            'whatsapp' => ['string', 'min:3', 'max:191', 'required'],
        ];

        if ($request->validate($rules)) {
            $results = $request->validate($rules);

            Settings::where('id', $id)->update($results);

            notify()->success('Data telah diperbarui', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
