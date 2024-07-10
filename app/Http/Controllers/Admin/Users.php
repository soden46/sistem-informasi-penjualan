<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Notify;

class Users extends Controller
{
    public function index()
    {
        $user = DB::table('users')->where('role', '!=', 'pelanggan')->get();
        $url = '/download-laporan-pembeli';
        $results = [
            'pagetitle' => 'Data Admin',
            'uri' => 'admin',
            'user' => $user,
            'url' => $url
        ];
        return view('admin.pages.admin', $results);
    }

    public function create(Request $request)
    {

        $rules =  [
            'name' => ['string', 'min:3', 'max:191', 'required'],
            'username' => ['string', 'min:3', 'max:191', 'required', 'unique:users'],
            'email' => ['email', 'string', 'min:3', 'max:191', 'required', 'unique:users'],
            'role' => ['string', 'min:3', 'max:191', 'required'],
            'photo' => ['string', 'required'],
        ];
        if ($request->validate($rules)) {
            $photo = $request['photo'];
            $results_data = [
                'nama' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'role' => $request['role'],
                'password' => bcrypt('123456'),
            ];
            if ($photo != "") {
                $name = now()->timestamp . "_{$photo->getClientOriginalName()}";
                $results =  [
                    'photo' => $name
                ];
                $concat = array_merge($results_data, $results);
                $location = 'assets/admin/images/users/';
                $photo->move($location, $name);
            } else {
                $validatedData = $results_data;
                $concat = $validatedData;
            }

            User::insert($concat);
            return back()->with('message', 'Data berhasil disimpan!');;
        } else {
            return back()->with('message', 'Data gagal disimpan!');;
        }
    }

    public function update(Request $request, $id)
    {
        $rules =  [
            'nama' => ['string', 'min:3', 'max:191', 'required'],
            'role' => ['string', 'min:3', 'max:191', 'required']
        ];

        if ($request->validate($rules)) {
            $username = DB::table('users')->where('username', $request['username'])->first();
            if ($request->username != $username->username) {
                $rules = [
                    'username' => ['string', 'min:3', 'max:191', 'required', 'unique:users'],
                    'email' => ['email', 'string', ',min:3', 'max:191', 'required', 'unique:users']
                ];
            }
            $user = User::find($id);
            $photo = $request['photo'];

            if ($request->photo != '') {

                $location = 'assets/admin/images/users/';
                if ($user->photo != ''  && $user->photo != null) {
                    $file_old = $location . $user->photo;
                    unlink($file_old);
                }
                $name = now()->timestamp . "_{$photo->getClientOriginalName()}";
                $results =  [
                    'photo' => $name
                ];
                $validatedData = $request->validate($rules);
                $concat = array_merge($validatedData, $results);
                $photo->move($location, $name);
            } else {
                $validatedData = $request->validate($rules);
                $concat = $validatedData;
            }
            User::where('id', $id)->update($concat);

            return back()->with('message', 'Data berhasil disimpan!');;
        } else {
            return back()->with('message', 'Data gagal disimpan!');;
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
            return back()->with('message', 'Data berhasil direset!');;
        } else {
            return back()->with('message', 'Data gagal direset!');;
        }
    }
}
