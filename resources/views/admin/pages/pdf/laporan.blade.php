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
                <h1>Laporan Data Penjualan<br>{{ profile()->nama_perusahaan }}</h1>
            </center>
            <p><b>Periode :</b> {{ $periode }}</p>
            <hr>
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="th">Nama Pelanggan</th>
                        <th class="th">Kategori</th>
                        <th class="th">Nama Barang</th>
                        <th class="th">Harga (Rp.)</th>
                        <th class="th">Jumlah</th>
                        <th class="th">Total (Rp.)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = '0' @endphp
                    @foreach ($transaksi as $item)
                    @php $total += $item->harga * $item->jumlah @endphp
                    <tr>
                        <td class="td">{{ $item->nama_pelanggan }}</td>
                        <td class="td">{{ $item->id_kategori }}</td>
                        <td class="td">{{ $item->nama_barang }}</td>
                        <td class="td">{{ number_format($item->harga) . '/' . $item->per }}</td>
                        <td class="td">{{ $item->jumlah }}</td>
                        <td class="td">{{ number_format($item->harga * $item->jumlah) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Total Pendapatan</th>
                        <th>Rp.{{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
            <div class="tandatangan">

                <br />

                <p>Diketahui</p>

                </br width="100px">

                <p>CV. Amarta Furniture</p>

            </div>
        </div>
    </div>
</body>

</html>