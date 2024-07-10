<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Notify;

class Pelanggan extends Controller
{
    public function index()
    {
        $user = DB::table('users')->where('role', 'pelanggan')->get();
        $url = '/download-laporan-pelanggan';
        $results = [
            'pagetitle' => 'Data Pelanggan',
            'uri' => 'admin',
            'user' => $user,
            'url' => $url
        ];
        return view('admin.pages.pelanggan', $results);
    }

    public function cetak_laporanPelanggan()
    {
        $user = DB::table('users')->where('role', '!=', 'pelanggan')->get();

        $results = [
            'pagetitle' => 'Data Pelanggan',
            'user' => $user,
        ];
        $pdf = Pdf::loadView('admin.pages.pdf.laporan-pelanggan', $results)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "Laporan-Pelanggan" . ".pdf";
        return $pdf->download('Laporan-Pelanggan' . $name);
    }

    public function create(Request $request)
    {
        $rules =  [
            'name' => ['string', 'min:3', 'max:191', 'required'],
            'username' => ['string', 'min:3', 'max:191', 'required', 'unique:users'],
            'email' => ['email', 'string', 'min:3', 'max:191', 'required'],
            'phone' => ['string', 'min:3', 'max:191', 'required'],
            'address' => ['string', 'min:3', 'max:191', 'required'],
            'password' => ['string', 'min:3', 'max:191', 'required'],
        ];

        $data = [
            'nama' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'no_hp' => $request['phone'],
            'alamat' => $request['address'],
            'password' => bcrypt($request['password']),
        ];

        User::insert($data);
        return redirect('login')->with('message', 'Berhasil Membuat Akun, Silahkan Login');;
    }

    public function update(Request $request, $id)
    {
        $rules =  [
            'name' => ['string', 'min:3', 'max:191', 'required'],
            'email' => ['email', 'string', 'min:3', 'max:191', 'required'],
            'phone' => ['string', 'min:3', 'max:191', 'required'],
            'address' => ['string', 'min:3', 'max:191', 'required'],
        ];

        if ($request->validate($rules)) {
            $username = DB::table('users')->where('username', $request['username'])->first();
            if ($request->username != $username->username) {
                $rules = [
                    'username' => ['string', 'min:3', 'max:191', 'required', 'unique:users'],
                ];
            }
            $data = [
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'password' => bcrypt($request['password']),
            ];
            User::where('id', $id)->update($data);

            return redirect('profil-pengguna')->with('message', 'Data berhasil disimpan!');;
        } else {
            return redirect('profil-pengguna')->with('message', 'Data gagal disimpan!');;
        }
    }

    public function delete($id)
    {
        if ($id != "") {
            User::where('id', $id)->delete();
            return back()->with('message', 'Data berhasil dihapus!');;
        } else {
            return back()->with('message', 'Data gagal dihapus!');;
        }
    }

    public function reset($id)
    {

        if ($id != '') {

            $data = [
                'password' => bcrypt('123456')
            ];

            User::where('id', $id)->update($data);
            return back()->with('message', 'Berhasil Melakukan Reset Password!');;
        } else {
            return back()->with('message', 'Gagal! Periksa Kembali data yang anda masukan');;
        }
    }
}
