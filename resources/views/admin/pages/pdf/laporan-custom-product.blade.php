<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Produk</title>
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
                <h1>Laporan Data Custom Produk<br>{{ profile()->nama_perusahaan }}</h1>
            </center>
            <hr>
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="th">Nama Produk</th>
                        <th class="th">Jumlah</th>
                        <th class="th">Desain</th>
                        <th class="th">Keterangan</th>
                        <th class="th">harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = '0' @endphp
                    @foreach ($custom as $item)
                        <tr>
                            <td class="td">{{ $item->nama_barang }}</td>
                            <td class="td">{{ $item->jumlah }}</td>
                            <td class="td">{{ $item->desain }}</td>
                            <td class="td">{{ $item->keterangan }}</td>
                            <td class="td">{{ $item->harga }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="tandatangan">

                <br />

                <p>Diketahui</p>

                </br width="100px">

                <p>Sidoluhur Furniture</p>

            </div>
        </div>
    </div>
</body>

</html>
