<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengiriman</title>
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
                <h1>Laporan Data Pengiriman<br>Sadiman Meubel Simbatan</h1>
            </center>
            <hr>
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="th">Nama Pelanggan</th>
                        <th class="th">Nama Barang</th>
                        <th class="th">Alamat</th>
                        <th class="th">Email</th>
                        <th class="th">No HP</th>
                        <th class="th">Status Pembayaran</th>
                        <th class="th">Status Pengirirman</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = '0' @endphp
                    @foreach ($kirim as $item)
                        <tr>
                            <td class="td">{{ $item->nama_pelanggan }}</td>
                            <td class="td">{{ $item->nama_barang }}</td>
                            <td class="td">{{ $item->alamat_pengiriman }}</td>
                            <td class="td">{{ $item->email }}</td>
                            <td class="td">{{ $item->no_telepon }}</td>
                            <td>{{ $item->status == '0' ? 'Belum Lunas' : ($item->status != '0' ? 'Lunas' : '') }}</td>
                            <td class="td">{{ $item->status_pengiriman }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="tandatangan">

                <br />

                <p>Diketahui</p>

                </br width="100px">

                <p>Sadiman Meubel Simbatan</p>

            </div>
        </div>
    </div>
</body>

</html>
