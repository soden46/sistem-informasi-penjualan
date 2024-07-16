<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\Transaksi as AdminTransaksi;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Notify;


class Transaksi extends Controller
{
    public function index()
    {
        $id_pelanggan = login()->id_user;
        $transaksi = DB::table('pembelian as a')
            ->select('a.*', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.id_kategori', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pelanggan', $id_pelanggan)->get();
        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
        ];
        return view('home.pages.transaksi', $results);
    }

    public function invoice($id_pembelian)
    {
        // Ambil data invoice
        $id_pelanggan = login()->id;
        $invoice = DB::table('pembelian as a')
            ->select('a.*', 'b.id_kategori', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pembelian', '=', $id_pembelian)->first(); // Menggunakan first() karena hanya ingin satu data

        // Jika invoice tidak ditemukan, bisa ditangani dengan penanganan khusus (contoh: redirect atau tampilan pesan error)

        // Ambil data rekening untuk pembayaran manual
        $rekening = DB::table('metode_pembayaran')->get();

        // Data untuk dikirim ke halaman invoice
        $results = [
            'pagetitle' => 'Invoice',
            'invoice' => $invoice,
            'rekening' => $rekening,
        ];

        // Tampilkan view invoice dengan data yang telah disiapkan
        return view('home.pages.invoice', $results);
    }

    public function pengiriman(Request $request, $id_pembelian)
    {
        $id_barang = $request['id_barang'];

        $rules =  [
            'status_pengiriman' => 'required',
        ];
        if ($request->validate($rules)) {
            $results = [
                'status_pengiriman' => $request['status_pengiriman']
            ];
            TransaksiModel::where('id_pembelian', $id_pembelian)->update($results);
            return back()->with('message', 'Data berhasil disimpan!');;
        } else {
            return back()->with('message', 'Data gagal disimpan!');;
        }
    }

    public function create(Request $request)
    {
        // dd(login()->id_user);
        $rules =  [
            'id_barang' => ['string', 'required'],
            'lokasi_pengiriman' => ['string', 'max:191', 'required'],
            'jumlah' => ['string', 'max:191', 'required'],
        ];
        $request->validate($rules);
        $data = [
            'id_pelanggan' => login()->id_user,
            'id_barang' => $request['id_barang'],
            'total_barang' => $request['jumlah'],
            'total_harga' => str_replace('.', '', $request['total']),
            'alamat_pengiriman' => $request['lokasi_pengiriman']
        ];
        TransaksiModel::insert($data);
        return redirect('transaksi')->with('message', 'Pesanan Berhasil Dibuat, Silahkan Melakukan Pembayaran!');
    }

    public function update(Request $request, $id_pembelian)
    {
        $rules = [
            'bukti_pembayaran' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ];

        $request->validate($rules);

        if ($request->hasFile('bukti_pembayaran')) {
            $foto = $request->file('bukti_pembayaran');
            $location = 'assets/upload/images/bukti_pembayaran/';
            $name = now()->timestamp . '_' . $foto->getClientOriginalName();
            $foto->move($location, $name);

            $results = [
                'bukti_pembayaran' => $name,
                'metode_pembayaran' => "Manual Bank Transfer"
            ];

            TransaksiModel::where('id_pembelian', $id_pembelian)->update($results);

            return back()->with('message', 'Bukti pembayaran berhasil dikirim. Tunggu konfirmasi Admin!');
        } else {
            return back()->with('message', 'Gagal mengunggah bukti pembayaran!');
        }
    }


    public function delete($id_pembelian)
    {
        if ($id_pembelian != "") {
            TransaksiModel::where('id_pembelian', $id_pembelian)->delete();
            return back()->with('message', 'Transaksi berhasil dibatalkan!');;
        } else {
            return back()->with('message', 'Transaksi gagal dibatalkan!');;
        }
    }

    public function download_invoice($id_pembelian)
    {
        $id_pelanggan = login()->id;
        $invoice = DB::table('pembelian as a')
            ->select('a.*', 'b.id_kategori', 'b.id_barang', 'b.id_kategori', 'b.nama_barang', 'b.deskripsi', 'b.harga', 'b.stok', 'b.satuan as per', 'c.nama as nama_pelanggan', 'c.no_telepon', 'c.email', 'd.nama_kategori')
            ->join('barang as b', 'a.id_barang', '=', 'b.id_barang')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id_user')
            ->join('kategori as d', 'b.id_kategori', '=', 'd.id_kategori')
            ->where('a.id_pembelian', '=', $id_pembelian)->get()->first();
        $data = [
            'invoice' =>  $invoice
        ];
        $pdf = Pdf::loadView('home.pages.pdf.invoice', $data)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "SIDOLUHUR_INV-0" . $invoice->id_pembelian . ".pdf";
        return $pdf->download($name);
    }

    public function bayar($id_pembelian)
    {
        // Ambil data transaksi berdasarkan ID pembelian
        $invoice = TransaksiModel::where('id_pembelian', $id_pembelian)->first();

        // Konfigurasi Midtrans
        Config::$serverKey = 'SB-Mid-server-h4kuKBzXVwsQoEYAfYikZZ-d'; // Masukkan server key Midtrans Anda
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data untuk dikirim ke halaman pembayaran Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $invoice->id_pembelian,
                'gross_amount' => $invoice->total_harga,
            ],
            'customer_details' => [
                'first_name' => $invoice->nama_pelanggan,
                'email' => $invoice->email,
                'phone' => $invoice->no_telepon,
            ],
        ];

        // Generate token Midtrans
        $snapToken = Snap::getSnapToken($params);
        $pagetitle = 'Invoice';

        // Tampilkan halaman pembayaran dengan Midtrans
        return view('home.pages.midtrans_payment', compact('snapToken', 'invoice', 'pagetitle'));
    }

    // Fungsi untuk menangani notifikasi dari Midtrans
    public function midtransNotification(Request $request)
    {
        // Verifikasi signature dari Midtrans
        $notif = new \Midtrans\Notification();

        // Proses notifikasi
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $fraud = $notif->fraud_status;
        $order_id = $notif->order_id;
        $amount = $notif->gross_amount;

        // Update status transaksi di database sesuai dengan notifikasi Midtrans
        // Contoh implementasi:
        $transaksi = TransaksiModel::where('id_pembelian', $order_id)->first();
        if ($transaksi) {
            if ($transaction == 'capture') {
                // Sukses: Update status transaksi di sini
                $transaksi->update([
                    'metode_pembayaran' => "Midtrans",
                ]);
            } else if ($transaction == 'settlement') {
                // Sukses: Update status transaksi di sini
                $transaksi->update([
                    'status' => 'success',
                ]);
            } else if ($transaction == 'pending') {
                // Menunggu: Update status transaksi di sini
                $transaksi->update([
                    'status' => 'pending',
                ]);
            } else if ($transaction == 'deny') {
                // Gagal: Update status transaksi di sini
                $transaksi->update([
                    'status' => 'failed',
                ]);
            } else if ($transaction == 'expire') {
                // Gagal: Update status transaksi di sini
                $transaksi->update([
                    'status' => 'expired',
                ]);
            } else if ($transaction == 'cancel') {
                // Dibatalkan: Update status transaksi di sini
                $transaksi->update([
                    'status' => 'canceled',
                ]);
            }
        }

        // Kirim respon ke Midtrans
        return response()->json(['success' => true]);
    }

    public function savePayment(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'id_pembelian' => 'required',
            'id_metode_pembayaran' => 'required',
            'jumlah' => 'required',
            'id_transaksi' => 'required',
            'status' => 'required',
        ]);

        DB::table('pembelian')->where('id_pembelian', $request->id_pembelian)->update(['status' => 1]);

        // Save payment details to the database
        $payment = new Pembayaran();
        $payment->id_pembeli = auth()->id(); // Assuming you have authentication
        $payment->id_pembelian = $request->id_pembelian;
        $payment->id_metode_pembayaran = 2;
        $payment->jumlah = $request->jumlah;
        $payment->id_transaksi = $request->id_transaksi;
        $payment->status = 1;
        $payment->tanggal_pembayaran = now(); // Current timestamp

        $payment->save();
        return redirect()->back()->with(['success' => 'Data pembayaran berhasil disimpan']);
    }
}
