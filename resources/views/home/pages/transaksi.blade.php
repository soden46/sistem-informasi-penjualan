    @extends('home.layouts.template')
    @section('css')
        <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @endsection
    @section('main')
        @include('home.layouts.breadcrumb')
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12 wow fadeInUp table-responsive" data-wow-delay="0.1s">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tanggal Pesanan</th>
                                    <th>Kategori</th>
                                    <th>Nama Barang</th>
                                    <th>Total</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Pesanan</th>
                                    <th>Status Pengiriman</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>Rp.{{ number_format($item->total_harga) }}</td>
                                        <td>{!! $item->bukti_pembayaran == ''
                                            ? ($item->status_pembayaran == '2'
                                                ? '<span class="badge bg-primary">Sudah Dibayar</span>'
                                                : ($item->status_pembayaran == '0'
                                                    ? '<span class="badge bg-danger">Belum Melakukan Pembayaran</span>'
                                                    : ($item->status_pembayaran == '1'
                                                        ? '<span class="badge bg-primary">Sudah Melakukan Pembayaran</span>'
                                                        : '<span class="badge bg-danger">Belum Melakukan Pembayaran</span>')))
                                            : ($item->status_pembayaran != ''
                                                ? '<span class="badge bg-secondary">Pembayaran di Proses</span>'
                                                : '') !!}</td>
                                        <td>{!! $item->status_pesanan == '0'
                                            ? '<span class="badge bg-danger"> Menunggu Konfirmasi</span>'
                                            : ($item->status_pesanan == '1'
                                                ? '<span class="badge bg-success"> Pesanan Disetujui</span>'
                                                : '<span class="badge bg-danger"> Menunggu Konfirmasi</span>') !!}</td>
                                        <td>{{ $item->status_pengiriman }}</td>
                                        <td>
                                            <a href="{{ url('invoice', $item->id_pembelian) }}" class="btn btn-success"><i
                                                    class="bi bi-card-list"> </i>
                                                Invoice</a>
                                            @if ($item->status_pembayaran != '1')
                                                <a href="{{ url('canceled/' . $item->id_pembelian) }}"
                                                    class="btn btn-danger"><i class="bi bi-x"></i>
                                                    Batalkan</a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    @endsection
