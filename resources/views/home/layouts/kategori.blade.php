<div class="container mt-4">
    <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <p class="fw-medium text-uppercase text-primary mb-2">Kategori</p>
        <h1 class="display-5 mb-5">Kategori Furniture</h1>
    </div>
    <div class="row g-4">
        <?php $delay = ['0.1s', '0.3s', '0.5s', '0.1s', '0.3s', '0.5s']; ?>
        @foreach ($kategori as $item)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $delay[rand(0, 5)] }}">
                <div class="team-item">
                    <a href="{{ route('kategori.show', $item->id_kategori) }}">
                        <img class="img-thumbnail" src="{{ url('assets/upload/images/barang/') }}" alt=""
                            style="height: 210px;object-fit: cover;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                                <img src="{{ url('assets/homepage/img/amartalogo.png') }}" alt=""
                                    style="height: 50px; width: auto; ">
                            </div>
                            <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                                style="height: 90px;">
                                <h4 style="line-height: 14px">{{ $item->nama_kategori }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
