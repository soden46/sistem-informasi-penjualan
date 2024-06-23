<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed " href="{{ url('data-mebel') }}">
                <i class="bi bi-card-checklist"></i>
                <span>Data Produk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed " href="{{ url('data-type') }}">
                <i class="bi bi-hash"></i>
                <span>Data Kategori</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#laporan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-list-check"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="laporan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('data-laporan') }}">
                        <i class="bi bi-circle"></i><span>Penjualan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('laporan/produk') }}">
                        <i class="bi bi-circle"></i><span>Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('laporan/pengiriman') }}">
                        <i class="bi bi-circle"></i><span>Pengiriman</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed " href="{{ url('data-rekening') }}">
                <i class="bi bi-credit-card"></i>
                <span>Rekening</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#pengguna-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pengguna-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('user/data-pelanggan') }}">
                        <i class="bi bi-circle"></i><span>Pelanggan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('user/data-admin') }}">
                        <i class="bi bi-circle"></i><span>Admin</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside><!-- End Sidebar-->