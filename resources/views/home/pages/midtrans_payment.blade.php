@extends('home.layouts.template')
@section('css')
@endsection
@section('main')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pembayaran dengan Midtrans</div>
                    <div class="card-body">
                        <input type="hidden" name="snapToken" id="snapToken" value="{{ $snapToken }}">
                        <input type="hidden" name="id_pembelian" id="id_pembelian" value="{{ $invoice->id_pembelian }}">
                        <input type="hidden" name="id_transaksi" id="id_transaksi" value="{{ $invoice->id_transaksi }}">
                        <button type="button" id="midtransPayButton" class="btn btn-primary"
                            data-token="{{ $snapToken }}">Bayar dengan Midtrans</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil token Midtrans dari tombol
            const midtransPayButton = document.getElementById('midtransPayButton');
            const snapToken = document.getElementById('snapToken').value;
            const idPembelian = document.getElementById('id_pembelian').value;
            const idTransaksi = document.getElementById('id_transaksi').value;

            // Handle klik tombol Bayar dengan Midtrans
            midtransPayButton.addEventListener('click', function() {
                // Pastikan snapToken tidak kosong
                if (snapToken) {
                    // Panggil fungsi untuk inisialisasi pembayaran Midtrans
                    initMidtransPayment(snapToken);
                } else {
                    alert('Snap Token tidak tersedia.');
                }
            });

            function initMidtransPayment(snapToken) {
                // Panggil Snap.js dengan Snap Token
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        alert('Pembayaran berhasil. Terima kasih atas pembayarannya!');
                        // Send AJAX request to save payment details
                        axios.post('/save-payment', {
                                id_pembelian: idPembelian,
                                id_metode_pembayaran: '2',
                                jumlah: result.gross_amount,
                                id_transaksi: idTransaksi,
                                status_pembayaran: 1, // Mengupdate status menjadi 2
                                metode_pembayaran: 'Midtrans'
                            })
                            .then(function(response) {
                                window.location.href = "{{ url('transaksi') }}";
                            })
                            .catch(function(error) {
                                alert('Gagal menyimpan data pembayaran. Silakan coba lagi.');
                            });
                    },
                    onPending: function(result) {
                        alert('Pembayaran tertunda. Silakan selesaikan pembayaran Anda.');
                        window.location.href = "{{ url('payment/pending') }}";
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal. Silakan coba lagi.');
                        window.location.href = "{{ url('payment/error') }}";
                    }
                });
            }
        });
    </script>
@section('script')
@endsection
@endsection
