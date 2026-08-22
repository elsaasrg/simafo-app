<aside class="main-sidebar">

    <!-- Brand Link (Hidden via CSS, but structured safely) -->
    <a href="#" class="brand-link d-none">
        <span class="brand-text font-weight-light">SIMAFO</span>
    </a>

    <!-- Blok Kustom CSS untuk Lebar Maksimal Kotak dan Kerapatan Menu -->
    <style>
        /* Mengatur ruang sidebar agar membentang penuh dengan struktur Flexbox */
        .sidebar {
            padding-left: 0.85rem !important;
            padding-right: 0.85rem !important;
            display: flex !important;
            flex-direction: column !important;
            height: calc(100vh - 140px) !important;
            /* Menyesuaikan tinggi sisa dari header */
        }

        .sidebar nav {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar .nav-sidebar {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
        }

        /* Merapatkan jarak antar kotak menu utama */
        .sidebar .nav-sidebar>.nav-item {
            margin-bottom: 10px !important;
        }

        /* Desain Kapsul Melengkung Penuh Sesuai Gambar Desain */
        .sidebar .nav-sidebar .nav-link {
            display: flex !important;
            align-items: center !important;
            width: 100% !important;
            padding: 14px 22px !important;
            border-radius: 10px !important;
            /* Membuat sudut melengkung penuh seperti kapsul */
            background-color: #F8F8C9 !important;
            /* Warna dasar krem kekuningan pastel */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.06), inset 0 -2px 0 rgba(0, 0, 0, 0.05) !important;
            /* Efek kedalaman bayangan */
            border: 1px solid rgba(0, 0, 0, 0.06) !important;
            transition: all 0.2s ease-in-out;
        }

        /* Mengatur teks di dalam menu */
        .sidebar .nav-sidebar .nav-link p {
            margin: 0 0 0 14px !important;
            flex-grow: 1 !important;
            white-space: normal !important;
            line-height: 1.2 !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            /* Huruf Kapital */
            font-size: 0.85rem !important;
            letter-spacing: 0.5px;
            color: #111111 !important;
        }

        .sidebar .nav-sidebar .nav-link i {
            color: #111111 !important;
            font-size: 1.1rem !important;
        }

        /* Memaksa ikon panah dropdown berada di ujung paling kanan kotak */
        .sidebar .nav-sidebar .nav-link .right {
            position: static !important;
            margin-left: auto !important;
            color: #111111 !important;
        }

        /* Menu Aktif (Warna Hijau Lime Cerah) */
        .sidebar .nav-sidebar .nav-link.active {
            background-color: #E4FF8C !important;
            /* Hijau lime presisi sesuai gambar */
            border-color: #CFE561 !important;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.1) !important;
        }

        /* Styling sub-menu dropdown agar melengkung manis di dalam */
        .sidebar .nav-treeview {
            padding-left: 12px !important;
            margin-top: 6px !important;
        }


        .sidebar .nav-treeview>.nav-item>.nav-link {
            padding: 10px 18px !important;
            margin-bottom: 6px !important;
            font-size: 0.8rem !important;
            border-radius: 10px !important;
            background-color: #F8F8C9 !important;
        }

        .sidebar .nav-treeview>.nav-item>.nav-link.active {
            background-color: #E4FF8C !important;
            /* Hijau lime presisi sesuai gambar */
            border-color: #CFE561 !important;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.1) !important;
        }

        /* Khusus Desain Tombol Log Out yang Nempel di Bawah */
        .sidebar-logout-item {
            margin-top: auto !important;
            /* Dorong otomatis ke paling bawah */
            margin-bottom: 20px !important;
            /* Jarak aman dari batas bawah screen */
        }

        .sidebar-logout-item .nav-link {
            background-color: #F7F9D7 !important;
            /* Warna latar disamakan agar seragam */
            border: 1px solid rgba(0, 0, 0, 0.06) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.06) !important;
        }

        .sidebar-logout-item .nav-link:hover {
            background-color: #fdf2f2 !important;
            /* Efek kemerahan soft saat di-hover */
        }
    </style>

    <div class="sidebar">
        <!-- User Panel (Hidden via CSS, but structured safely) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-none">
            <div class="info">
                <p class="text-white">Sistem Informasi</p>
            </div>
        </div>

        <!-- Menu Navigasi -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">

                <!-- Menu Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- MENU KHUSUS ROLE ADMIN -->
                @role('Admin')
                <li class="nav-item has-treeview {{ request()->is('mahasiswa*') || request()->is('dosen*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Kelola Pengguna</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: {{ request()->is('mahasiswa*') || request()->is('dosen*') ? 'block' : 'none' }};">
                        <li class="nav-item">
                            <a href="{{ url('mahasiswa') }}" class="nav-link {{ request()->is('mahasiswa*') ? 'active' : '' }}">
                                <i class="fas fa-user-graduate nav-icon"></i>
                                <p>Kelola Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dosen') }}" class="nav-link {{ request()->is('dosen*') ? 'active' : '' }}">
                                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                <p>Kelola Dosen</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ request()->is('aktivitas*') || request()->is('organisasi*') || request()->is('beasiswa*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Rekam Jejak Kegiatan</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: {{ request()->is('aktivitas*') || request()->is('organisasi*') || request()->is('beasiswa*') ? 'block' : 'none' }};">
                        <li class="nav-item">
                            <a href="{{ url('/aktivitas') }}" class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Aktivitas & Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/organisasi') }}" class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Organisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}" class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Beasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}" class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Kelola Informasi Lomba</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}" class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Kelola Informasi Beasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/pengajuan-surat') }}" class="nav-link {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Pengajuan Surat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}" class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Tracer Study</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/aduan') }}" class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Aduan</p>
                    </a>
                </li>
                @endrole

                <!-- MENU KHUSUS ROLE MAHASISWA -->
                @role('Mahasiswa')
                <li class="nav-item has-treeview {{ request()->is('aktivitas*') || request()->is('organisasi*') || request()->is('beasiswa*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Rekam Jejak Kegiatan</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: {{ request()->is('aktivitas*') || request()->is('organisasi*') || request()->is('beasiswa*') ? 'block' : 'none' }};">
                        <li class="nav-item">
                            <a href="{{ url('aktivitas') }}" class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelola Data Aktivitas & Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('organisasi') }}" class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelola Data Organisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}" class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelola Data Beasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}" class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Informasi Lomba</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}" class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Informasi Beasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/pengajuan-surat') }}" class="nav-link {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Pengajuan Surat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/konseling') }}" class="nav-link {{ request()->is('konseling*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Konseling</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/aduan') }}" class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Aduan</p>
                    </a>
                </li>
                @endrole

                <!-- MENU KHUSUS ROLE KAJUR -->
                @role('Kajur')
                <li class="nav-item has-treeview {{ request()->is('aktivitas*') || request()->is('organisasi*') || request()->is('beasiswa*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Rekam Jejak Kegiatan</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview" style="display: {{ request()->is('aktivitas*') || request()->is('organisasi*') || request()->is('beasiswa*') ? 'block' : 'none' }};">
                        <li class="nav-item">
                            <a href="{{ url('/aktivitas') }}" class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Aktivitas & Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/organisasi') }}" class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Organisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}" class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Beasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/aduan') }}" class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Aduan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}" class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Tracer Study</p>
                    </a>
                </li>
                @endrole

                <!-- MENU KHUSUS ROLE DOSEN KEMAHASISWAAN -->
                @role('DosenKemahasiswaan')
                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}" class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Kelola Informasi Lomba</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}" class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Kelola Informasi Beasiswa</p>
                    </a>
                </li>
                @endrole

                <!-- MENU KHUSUS ROLE DOSEN -->
                @role('Dosen')
                <li class="nav-item">
                    <a href="{{ url('/konseling') }}" class="nav-link {{ request()->is('konseling*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Konseling</p>
                    </a>
                </li>
                @endrole

                <!-- MENU KHUSUS ROLE ALUMNI -->
                @role('Alumni')
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}" class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Tracer Study</p>
                    </a>
                </li>
                @endrole

                <!-- Menu Log Out (Sekarang Menggunakan Class Khusus Sticky Bottom) -->
                <li class="nav-item sidebar-logout-item">
                    <form action="{{ route('logout') }}" method="post" id="logout-form-aside" class="d-none">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-aside').submit();" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Log Out</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>

</aside>