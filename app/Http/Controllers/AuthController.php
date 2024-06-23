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
            'pagetitle' => 'Masuk | Sadiman Meubel Simbatan'
        ];
        return view('auth.login', $results);
    }

    public function register()
    {
        $results = [
            'pagetitle' => 'Masuk | Sadiman Meubel Simbatan'
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
                notify()->success('Selamat Datang di Sadiman Meubel Simbatan', 'Berhasil');
                return redirect('dashboard');
            } elseif ($user->role == 'pelanggan') {
                notify()->success('Selamat Datang di Sadiman Meubel Simbatan', 'Berhasil');
                return redirect('/');
            }
            return redirect()->back();
        }
        notify()->warning('Akun tidak terdaftar', 'Gagal');
        return redirect('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('/');
    }
}
