<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light text-white">SIMAFO</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <p class="text-white font-weight-light" style="white-space: normal; height: auto;">Sistem Informasi <span class="d-block">Kemahasiswaan</span> </p>
            </div>
        </div>

        <nav class="mt-2 mb-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('home')}}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p style="white-space: normal; height: auto;">Dashboard <span class="right badge badge danger"></span></p>
                    </a>
                </li>

                @role('Admin')
                <li class="nav-item has-treeview {{ request()->is('users*') || request()->is('mahasiswa*') || request()->is('admin/dosen*') || request()->is('alumni*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p style="white-space: normal; height: auto; pr-4">
                            Kelola Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('mahasiswa')}}" class="nav-link {{ request()->is('mahasiswa*') ? 'active' : '' }}">
                                <i class="fas fa-user-graduate nav-icon"></i>
                                <p style="white-space: normal; height: auto;">Kelola Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('dosen')}}" class="nav-link {{ request()->is('dosen*') ? 'active' : '' }}">
                                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                <p style="white-space: normal; height: auto;">Kelola Dosen</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ request()->is('organisasi*') ||  request()->is('beasiswa*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{  request()->is('organisasi*') || request()->is('beasiswa*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p style="white-space: normal; height: auto;">
                            Rekam Jejak Kegiatan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/aktivitas') }}" class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Lihat Data Aktivitas dan Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/organisasi') }}" class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Data Organisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}" class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Data Beasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}" class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }} d-flex align-items-start">
                        <i class="far fa-circle nav-icon mt-1"></i>
                        <p style="white-space: normal; height: auto; margin-bottom: 0;">Kelola Informasi Beasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}" class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }} d-flex align-items-start">
                        <i class="far fa-circle nav-icon mt-1"></i>
                        <p style="white-space: normal; height: auto; margin-bottom: 0;">Kelola Informasi Lomba</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/pengajuan-surat') }}" class="nav-link {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Pengajuan Surat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}" class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Tracer Study</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/aduan') }}" class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Aduan</p>
                    </a>
                </li>
                @endrole

                @role('Mahasiswa')
                <li class="nav-item has-treeview {{ request()->is('organisasi*') || request()->is('beasiswa*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('organisasi*') || request()->is('beasiswa*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p style="white-space: normal; height: auto;">
                            Rekam Jejak Kegiatan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('aktivitas') }}" class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Kelola Data Aktivitas dan Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('organisasi') }}" class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Kelola Data Organisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}" class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Kelola Data Beasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}" class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Lihat Informasi Lomba</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}" class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Lihat Informasi Beasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/pengajuan-surat') }}" class="nav-link {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Pengajuan Surat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/konseling') }}" class="nav-link {{ request()->is('konseling*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Konseling</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/aduan') }}" class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Aduan</p>
                    </a>
                </li>
                @endrole

                @role('Kajur')
                <li class="nav-item has-treeview {{ request()->is('organisasi*') ||  request()->is('beasiswa*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{  request()->is('organisasi*') || request()->is('beasiswa*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p style="white-space: normal; height: auto;">
                            Rekam Jejak Kegiatan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/aktivitas') }}" class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Lihat Data Aktivitas dan Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/organisasi') }}" class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Lihat Data Organisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}" class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }} d-flex align-items-start">
                                <i class="far fa-circle nav-icon mt-1"></i>
                                <p style="white-space: normal; height: auto; margin-bottom: 0;">Lihat Data Beasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/aduan') }}" class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Kelola Aduan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}" class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Tracer Study</p>
                    </a>
                </li>
                @endrole

                @role('DosenKemahasiswaan')
                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}" class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }} d-flex align-items-start">
                        <i class="far fa-circle nav-icon mt-1"></i>
                        <p style="white-space: normal; height: auto; margin-bottom: 0;">Kelola Informasi Lomba</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}" class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }} d-flex align-items-start">
                        <i class="far fa-circle nav-icon mt-1"></i>
                        <p style="white-space: normal; height: auto; margin-bottom: 0;">Kelola Informasi Beasiswa</p>
                    </a>
                </li>
                @endrole

                @role('Dosen')
                <li class="nav-item">
                    <a href="{{ url('/konseling') }}" class="nav-link {{ request()->is('konseling*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Konseling</p>
                    </a>
                </li>
                @endrole

                @role('Alumni')
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}" class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="white-space: normal; height: auto;">Tracer Study</p>
                    </a>
                </li>
                @endrole
                <li class="nav-item mb-3">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link w-100 text-left">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>

                </li>
            </ul>
        </nav>
    </div>


</aside>