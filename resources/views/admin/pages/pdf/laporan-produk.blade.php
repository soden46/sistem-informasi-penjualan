<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk</title>
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
                <h1>Laporan Data Produk<br>{{ profile()->nama_perusahaan }}</h1>
            </center>
            <hr>
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="th">Nama Produk</th>
                        <th class="th">Kategori</th>
                        <th class="th">Bahan</th>
                        <th class="th">Deskripsi</th>
                        <th class="th">Finishing</th>
                        <th class="th">Ukuran</th>
                        <th class="th">Jumlah</th>
                        <th class="th">Harga (Rp.)</th>
                        <th class="th">Stok</th>
                        <th class="th">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = '0' @endphp
                    @foreach ($produk as $item)
                    <tr>
                        <td class="td">{{ $item->nama_barang }}</td>
                        <td class="td">{{ $item->kategori }}</td>
                        <td class="td">{{ $item->bahan }}</td>
                        <td class="td">{{ $item->deskripsi }}</td>
                        <td class="td">{{ $item->finishing }}</td>
                        <td class="td">{{ $item->ukuran }}</td>
                        <td class="td">{{ $item->jumlah }}</td>
                        <td class="td">{{ $item->harga }}</td>
                        <td class="td">{{ $item->stok }}</td>
                        <td class="td">{{ $item->gambar }}</td>
                    </tr>
                    @endforeach
                </tbody>
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