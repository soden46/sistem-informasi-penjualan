<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pelanggan</title>
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
                <h1>Laporan Data Pelanggan<br>{{ profile()->nama_perusahaan }}</h1>
            </center>
            <hr>
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="th">Nama Pelanggan</th>
                        <th class="th">Email</th>
                        <th class="th">Alamat</th>
                        <th class="th">No HP</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = '0' @endphp
                    @foreach ($user as $item)
                    <tr>
                        <td class="td">{{ $item->nama }}</td>
                        <td class="td">{{ $item->email }}</td>
                        <td class="td">{{ $item->alamat }}</td>
                        <td class="td">{{ $item->no_hp }}</td>
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