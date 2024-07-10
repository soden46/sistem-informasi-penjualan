<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Notify;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->role == 'admin') {
                return redirect()->intended('admin');
            } elseif ($user->role == 'owner') {
                return redirect()->intended('owner');
            }
        }
        $results = [
            'pagetitle' => 'Masuk | Sidoluhur Furniture'
        ];
        return view('auth.login', $results);
    }

    public function register()
    {
        $results = [
            'pagetitle' => 'Masuk | Sidoluhur Furniture'
        ];
        return view('auth.register', $results);
    }

    public function proses_login(Request $request)
    {
        // dd($request);
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );
        $kredensil = $request->only('username', 'password');
        if (Auth::attempt($kredensil)) {
            $user = Auth::user();
            // dd($user);
            if ($user->role == 'admin') {

                return redirect('dashboard')->with('message', 'Berhasil Login');;
            } elseif ($user->role == 'pelanggan') {
                return redirect('/')->with('message', 'Sukses Login');;
            }
            return redirect()->back();
        }
        return redirect('login')->with('message', 'Gagal Login, Periksa Username Atau Password Anda!');;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('/');
    }
}
