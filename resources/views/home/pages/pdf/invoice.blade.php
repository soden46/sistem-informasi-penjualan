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
        .th {
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

        footer {
            position: fixed;
            bottom: 20px;
            left: 0px;
            right: 0px;
            height: 150px;
            text-align: center;
            vertical-align: top
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title fs-4">#INV-0{{ $invoice->id_pembelian }}</h2>
            <h4>Sadiman Meubel Sombatan</h4>

            <div class="pt-2">
                <table>
                    <tr>
                        <td>Nama Pemesan</td>
                        <td class="text-center">:</td>
                        <td>{{ $invoice->nama_pelanggan }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="text-center">:</td>
                        <td>{{ $invoice->email }}</td>
                    </tr>
                    <tr>
                        <td>No. Telepon</td>
                        <td class="text-center">:</td>
                        <td>{{ $invoice->no_telepon }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Pengiriman</td>
                        <td class="text-center">:</td>
                        <td>{{ $invoice->alamat_pengiriman }}</td>
                    </tr>
                    <tr>
                        <td>Tgl. Pembelian</td>
                        <td class="text-center">:</td>
                        <td>{{ $invoice->created_at }}</td>
                    </tr>
                </table>
            </div>
            <div class="pt-4">
                @if ($invoice->status != '0')
                    <p class="text-center fw-bold text-success">[LUNAS]</p>
                @else
                    <p class="text-center fw-bold text-danger">[BELUM LUNAS]</p>
                @endif
                <h4 class="card-subtitle mb-2 text-muted">Detail Pesanan</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="th">Kategori</th>
                                <th class="th">Nama Barang</th>
                                <th class="th">Total barang (Unit)</th>
                                <th class="th">Total Harga (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td">{{ $invoice->nama_kategori }}</td>
                                <td class="td">{{ $invoice->nama_barang }}</td>
                                <td class="td">{{ number_format($invoice->total_barang) }}</td>
                                <td class="td">{{ number_format($invoice->total_harga) }}</td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Total: {{ number_format($invoice->total_harga) }}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <i>Terimakasih atas kerjasamanya</i>
                <footer>
                    <table style="width: 50%; vertical-align: top;">
                        <tr>
                            <td style="vertical-align: text-top">Telepon</td>
                            <td style="vertical-align: text-top" class="text-center">:</td>
                            <td style="vertical-align: text-top"></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: text-top">Whatsapp</td>
                            <td style="vertical-align: text-top" class="text-center">:</td>
                            <td style="vertical-align: text-top"></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: text-top">Email</td>
                            <td style="vertical-align: text-top" class="text-center">:</td>
                            <td style="vertical-align: text-top"></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: text-top">Alamat</td>
                            <td style="vertical-align: text-top" class="text-center">:</td>
                            <td style="vertical-align: text-top"></td>
                        </tr>
                    </table>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
