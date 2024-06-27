<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            font-size: 12px;
            font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
        }

        .table,
        .td,
        .th,
        thead {
            border: 1px solid black;
            text-align: center
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .text-success {
            color: green
        }

        .text-danger {
            color: red
        }

        .fw-bold {
            font-weight: bold
        }

        .tandatangan {

            text-align: center;
            margin-left: 545px;

        }

        @media print {

            body {

                font-size: 11px;

            }

            .tandatangan {

                text-align: center;
                margin-left: 345px;

            }
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <center>
                <h1>Laporan Data Penjualan<br>Sadiman Maubel Simbatan</h1>
            </center>
            <p><b>Periode :</b> {{ $periode }}</p>
            <hr>
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th>Tanggal Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Barang</th>
                        <th>Total Barang</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach ($transaksi as $item)
                        @php $total += $item->total_harga @endphp
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>Rp.{{ number_format($item->total_harga) }}</td>
                            <td>Rp.{{ number_format($item->total_barang) }}</td>
                            <td>
                                {!! $item->status == '0'
                                    ? '<span class="badge bg-danger">Belum Lunas</span>'
                                    : ($item->status == '1'
                                        ? '<span class="badge bg-success">Lunas</span>'
                                        : '') !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total Pendapatan</th>
                        <th>Rp.{{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
            <div class="tandatangan">

                <br />

                <p>Diketahui</p>

                </br width="100px">

                <p>Sadiman Maubel Simbatan</p>

            </div>
        </div>
    </div>
</body>

</html>
