<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('home') }}" class=" waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboards</span>
                    </a>
                </li>
                @role('superadmin')
                <li>
                    <a href="{{ route('pengguna.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                @endrole
                <li>
                    <a href="{{ route('Produk') }}" class=" waves-effect">
                        <i class="bx bx-user-pin"></i>
                        <span>Produk</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('Penjualan') }}" class=" waves-effect">
                        <i class="bx bx-user-pin"></i>
                        <span>Penjualan</span>
                    </a>
                </li>


                @role('superadmin')
                <li>
                    <a href="{{ route('Prediksi') }}" class=" waves-effect">
                        <i class="bx bx-user-pin"></i>
                        <span>Prediksi</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('data-prediksi') }}" class=" waves-effect">
                        <i class="bx bx-user-pin"></i>
                        <span>Data Prediksi</span>
                    </a>
                </li>


                {{-- <li>
                    <a href="{{ route('talenta') }}" class=" waves-effect">
                        <i class="bx bx-tag"></i>
                        <span>Data Talenta</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('ruangan') }}" class=" waves-effect">
                        <i class="bx bx-buildings"></i>
                        <span>Data Ruangan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('waktu') }}" class=" waves-effect">
                        <i class="bx bx-time-five"></i>
                        <span>Waktu Pelayanan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('penjadwalan')}}" class=" waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span>Proses Jadwal</span>
                    </a>
                </li> --}}
                @endrole
                
                {{-- <li>
                    <a href="{{ route('daftar-jadwal')}}" class=" waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span>Jadwal Pelayan</span>
                    </a>
                </li> --}}

            
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
