<?php

use App\Http\Controllers\Admin\Dashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\Home\Homepage@index')->name('homepage');
Route::get('/tentang', 'App\Http\Controllers\Home\Homepage@faqs')->name('about');
Route::get('/cara-pemesanan', 'App\Http\Controllers\Home\Homepage@cara')->name('cara_pemesanan');
Route::get('/produk', 'App\Http\Controllers\Home\Homepage@barang')->name('produk');
Route::get('/kategori/{id_kategori}', 'App\Http\Controllers\Home\KategoriController@show')->name('kategori.show');
Route::get('/profil-pengguna', 'App\Http\Controllers\Home\Homepage@profile')->name('profile');
Route::get('/detail-mebel/{id_barang}', 'App\Http\Controllers\Home\Homepage@detail')->name('detail')->middleware('cek_login:pelanggan,admin');
Route::get('/transaksi', 'App\Http\Controllers\Home\Transaksi@index')->name('Transaksi')->middleware('cek_login:pelanggan,admin');
Route::get('/invoice/{post}', 'App\Http\Controllers\Home\Transaksi@invoice')->name('invoice')->middleware('cek_login:pelanggan,admin');
Route::get('/invoicec/{post}', 'App\Http\Controllers\Home\Transaksi@invoicec')->name('invoicec')->middleware('cek_login:pelanggan,admin');
Route::post('/confirm', 'App\Http\Controllers\Home\Transaksi@create')->middleware('cek_login:pelanggan,admin');
Route::put('/payment/{post}', 'App\Http\Controllers\Home\Transaksi@update')->middleware('cek_login:pelanggan');
Route::get('/canceled/{post}', 'App\Http\Controllers\Home\Transaksi@delete')->middleware('cek_login:pelanggan');
Route::get('/download-invoice/{post}', 'App\Http\Controllers\Home\Transaksi@download_invoice')->middleware('cek_login:pelanggan,owner,admin');
Route::get('/download-invoicec/{post}', 'App\Http\Controllers\Home\Transaksi@download_invoicec')->middleware('cek_login:pelanggan,owner,admin');


Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::get('/dashboard', 'App\Http\Controllers\Admin\Dashboard@index')->name('dashboard')->middleware('cek_login:admin,owner');
Route::get('/profile', 'App\Http\Controllers\Admin\Dashboard@profile')->name('profile')->middleware('cek_login:admin,owner');
Route::put('/update-profile/{post}', 'App\Http\Controllers\Admin\Dashboard@profile_update')->middleware('cek_login:admin,owner');
Route::put('/update-password/{post}', 'App\Http\Controllers\Admin\Dashboard@password_update')->middleware('cek_login:admin,owner,pelanggan');

Route::get('/data-profil-perusahaan', 'App\Http\Controllers\Admin\ProfilPerusahaan@index')->name('profil-perusahaan')->middleware('cek_login:admin,owner');
Route::put('/update-profile-perusahaan/{post}', 'App\Http\Controllers\Admin\ProfilPerusahaan@update')->name('update')->middleware('cek_login:admin,owner');

Route::get('/user/data-admin', 'App\Http\Controllers\Admin\Users@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-user', 'App\Http\Controllers\Admin\Users@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-user/{post}', 'App\Http\Controllers\Admin\Users@update')->name('update')->middleware('cek_login:admin,owner');
Route::put('/reset-data-user/{post}', 'App\Http\Controllers\Admin\Users@reset')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-user/{post}', 'App\Http\Controllers\Admin\Users@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('/user/data-pelanggan', 'App\Http\Controllers\Admin\Pelanggan@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-pelanggan', 'App\Http\Controllers\Admin\Pelanggan@create')->name('create');
Route::put('/update-data-pelanggan/{post}', 'App\Http\Controllers\Admin\Pelanggan@update')->name('update');
Route::put('/reset-data-pelanggan/{post}', 'App\Http\Controllers\Admin\Pelanggan@reset')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-pelanggan/{post}', 'App\Http\Controllers\Admin\Pelanggan@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('/data-type', 'App\Http\Controllers\Admin\Type@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-type', 'App\Http\Controllers\Admin\Type@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-type/{post}', 'App\Http\Controllers\Admin\Type@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-type/{post}', 'App\Http\Controllers\Admin\Type@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('/data-mebel', 'App\Http\Controllers\Admin\Barang@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-mebel', 'App\Http\Controllers\Admin\Barang@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-mebel/{post}', 'App\Http\Controllers\Admin\Barang@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-mebel/{post}', 'App\Http\Controllers\Admin\Barang@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::put('/update-data-custom/{post}', 'App\Http\Controllers\Admin\CustomProduct@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-custom/{post}', 'App\Http\Controllers\Admin\CustomProduct@delete')->name('delete')->middleware('cek_login:admin,owner');



Route::get('/data-rekening', 'App\Http\Controllers\Admin\Rekening@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-rekening', 'App\Http\Controllers\Admin\Rekening@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-rekening/{post}', 'App\Http\Controllers\Admin\Rekening@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-rekening/{post}', 'App\Http\Controllers\Admin\Rekening@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('laporan/transaksi', 'App\Http\Controllers\Admin\Transaksi@index')->name('admin')->middleware('cek_login:admin,owner');
Route::get('/detail-transaksi/{post}', 'App\Http\Controllers\Admin\Transaksi@invoice')->name('admin')->middleware('cek_login:admin,owner');
Route::get('/detail-transaksic/{post}', 'App\Http\Controllers\Admin\Transaksi@invoicec')->name('admin')->middleware('cek_login:admin,owner');
Route::put('/confirm-transaksi/{post}', 'App\Http\Controllers\Admin\Transaksi@update')->name('update')->middleware('cek_login:admin,owner');
Route::get('/delete-transaksi/{post}', 'App\Http\Controllers\Admin\Transaksi@delete')->name('delete')->middleware('cek_login:admin,owner');
Route::get('/download-invoice-/{post}', 'App\Http\Controllers\Admin\Transaksi@download_invoice')->middleware('cek_login:owner,admin');

Route::get('laporan/produk', 'App\Http\Controllers\Admin\Transaksi@laporanProduk')->name('admin')->middleware('cek_login:admin,owner');
Route::get('laporan/custom-produk', 'App\Http\Controllers\Admin\Transaksi@custom_product')->name('admin')->middleware('cek_login:admin,owner');
Route::get('laporan/pengiriman', 'App\Http\Controllers\Admin\Pengiriman@index')->name('admin')->middleware('cek_login:admin,owner');
Route::get('laporan/pembeli', 'App\Http\Controllers\Admin\pembeli@index')->name('admin')->middleware('cek_login:admin,owner');

Route::get('/data-laporan', 'App\Http\Controllers\Admin\Transaksi@laporan')->name('admin')->middleware('cek_login:admin,owner');
Route::get('/download-laporan', 'App\Http\Controllers\Admin\Transaksi@cetak_laporan')->middleware('cek_login:owner,admin');
Route::get('/download-laporan-produk', 'App\Http\Controllers\Admin\Transaksi@cetak_laporanProduk')->middleware('cek_login:owner,admin');
Route::get('/download-laporan-custom-produk', 'App\Http\Controllers\Admin\Transaksi@cetak_laporanCustom')->middleware('cek_login:owner,admin');
Route::get('/download-laporan-pengiriman', 'App\Http\Controllers\Admin\Transaksi@cetak_laporanPengiriman')->middleware('cek_login:owner,admin');
Route::get('/download-laporan-pelanggan', 'App\Http\Controllers\Admin\Pelanggan@cetak_laporanPelanggan')->middleware('cek_login:owner,admin');

Route::post('/create-data-mebel', 'App\Http\Controllers\Admin\Barang@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-mebel/{post}', 'App\Http\Controllers\Admin\Barang@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-mebel/{post}', 'App\Http\Controllers\Admin\Barang@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::put('/update-data-pengiriman/{post}', 'App\Http\Controllers\Admin\Pengiriman@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-pengiriman/{post}', 'App\Http\Controllers\Admin\Pengiriman@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('laporan/pengiriman', 'App\Http\Controllers\Admin\Pengiriman@index')->name('admin')->middleware('cek_login:admin,owner');
