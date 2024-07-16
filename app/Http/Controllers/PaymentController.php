<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Transaction;
use DB;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    }

    public function invoice($id_pembelian)
    {
        $id_pelanggan = auth()->id();
        $invoice = DB::table('pembelian as a')
            ->select('a.*', 'b.id_kategori', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pembelian', '=', $id_pembelian)->first();

        $rekening = DB::table('metode_pembayaran')->get();

        // Buat parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'INV-0' . $invoice->id_pembelian,
                'gross_amount' => $invoice->total_harga,
            ],
            'customer_details' => [
                'first_name' => $invoice->nama_pelanggan,
                'email' => $invoice->email,
                'phone' => $invoice->no_telepon,
                'shipping_address' => $invoice->alamat_pengiriman,
            ],
            'item_details' => [
                [
                    'id' => $invoice->id_barang,
                    'price' => $invoice->harga,
                    'quantity' => 1,
                    'name' => $invoice->nama_barang,
                ]
            ]
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Return ke view dengan Snap Token
        return view('home.pages.invoice', compact('invoice', 'rekening', 'snapToken'));
    }

    public function callback(Request $request)
    {
        $json = json_decode($request->getContent());
        $order_id = $json->order_id;
        $transaction_status = $json->transaction_status;

        // Lakukan logika yang sesuai berdasarkan status transaksi
        if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
            DB::table('pembelian')
                ->where('id_pembelian', str_replace('INV-0', '', $order_id))
                ->update(['status' => 'paid']);
        }

        return response()->json(['status' => 'success']);
    }
}
