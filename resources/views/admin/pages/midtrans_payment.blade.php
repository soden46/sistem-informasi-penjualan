@extends('layouts.app') {{-- Sesuaikan dengan layout yang Anda gunakan --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pembayaran</div>

                    <div class="card-body">
                        <form action="{{ route('transaksi.midtrans.notification') }}" method="post">
                            @csrf
                            <input type="hidden" name="snapToken" value="{{ $snapToken }}">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
