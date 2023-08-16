   <!-- Navbar Start -->
   <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
       <a href="{{ url('') }}" class="navbar-brand ps-5 me-0">
           <div class="d-flex align-items-center gap-2">
               <img src="{{ url('assets/homepage/img/amartalogo.png') }}" alt="" style="height: 50px; width: auto; ">
           </div>
       </a>
       <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarCollapse">
           <div class="navbar-nav ms-auto p-4 p-lg-0">
               <a href="{{ url('') }}" class="nav-item nav-link {{ $pagetitle == 'Homepage' ? 'active' : '' }}">Home</a>
               <a href="{{ url('tentang') }}" class="nav-item nav-link {{ $pagetitle == 'Tentang Kami' ? 'active' : '' }}">Tentang Kami</a>
               <a href="{{ url('produk') }}" class="nav-item nav-link {{ $pagetitle == 'Produk' ? 'active' : '' }}">Produk</a>
               <a href="{{ url('pelanggan/custom-produk') }}" class="nav-item nav-link {{ $pagetitle == 'Custom Produk' ? 'active' : '' }}">Custom Produk</a>
               <a href="{{ url('cara-pemesanan') }}" class="nav-item nav-link {{ $pagetitle == 'Cara Pemesanan' ? 'active' : '' }}">Cara Pemesanan</a>
               @if (login())
               <div class="nav-item dropdown">
                   <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ login()->name }}</a>
                   <div class="dropdown-menu bg-light m-0">
                       <a href="{{ url('profil-pengguna') }}" class="dropdown-item">Profile</a>
                       <a href="{{ url('transaksi') }}" class="dropdown-item">Transaksi</a>
                       <a href="{{ url('logout') }}" class="dropdown-item text-danger">Keluar</a>
                   </div>
               </div>
               @else
               <a href="{{ url('login') }}" class="nav-item nav-link">Login</a>
               @endif
           </div>
       </div>
   </nav>
   <!-- Navbar End -->