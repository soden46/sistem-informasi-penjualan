<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Furniture Sesuai Kategori</p>
            <h1>Barang di Kategori: {{ $kategori->nama_kategori }}</h1>
        </div>
        <div class="row g-4">
            <?php $delay = ['0.1s', '0.3s', '0.5s', '0.1s', '0.3s', '0.5s']; ?>
            @foreach ($barang as $item)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $delay[rand(0, 5)] }}">
                    <div class="team-item">
                        <a href="{{ url('detail-mebel/' . $item->id_barang) }}">
                            <img class="img-thumbnail"
                                src="{{ url('assets/upload/images/barang/' . ($item->foto ?? 'default.jpg')) }}"
                                alt="" style="height: 210px;object-fit: cover;">
                        </a>
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                                <img src="{{ url('assets/homepage/img/sidoluhur.png') }}" alt=""
                                    style="height: 50px; width: auto;">
                            </div>
                            <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                                style="height: 90px;">
                                <h4 style="line-height: 14px">{{ $item->nama_barang }}</h4>
                                <span class="text-primary">Rp.{{ number_format($item->harga) }}<small>
                                        /{{ $item->satuan }}</small></span>
                                <div class="d-flex gap-2">
                                    @if ($item->stok > 0)
                                        <span><i class="fa-solid fa-boxes-stacked"></i> Stok: {{ $item->stok }}</span>
                                    @endif
                                </div>
                                <div class="team-social">
                                    @if ($item->stok > 0)
                                        <a class="btn btn-dark mx-1"
                                            href="{{ url('detail-mebel/' . $item->id_barang) }}">
                                            <i class="bi bi-file-earmark-plus"></i> Pesan
                                        </a>
                                    @else
                                        <button class="btn btn-warning disabled mx-1">Tidak Tersedia</button>
                                    @endif
                                    <a class="btn btn-dark mx-1" href="{{ url('detail-mebel/' . $item->id_barang) }}"
                                        id="id" name="id">
                                        <i class="bi bi-info-circle"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
