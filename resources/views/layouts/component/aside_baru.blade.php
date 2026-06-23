<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light text-white">SIMAFO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <p class="text-white font-weight-light">Sistem Informasi <span class="d-block">Kemahasiswaan</span> </p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('home')}}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard <span class="right badge badge danger"></span>
                        </p>
                    </a>
                </li>

                <!-- ROLE ADMIN -->

                @role('Admin')
                <li class="nav-item has-treeview {{ request()->is('users*') || request()->is('mahasiswa*') || request()->is('admin/dosen*') || request()->is('alumni*') ? 'menu-open' : '' }}">

                    <a href="#"
                        class="nav-link">

                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Kelola Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{url('mahasiswa')}}"
                                class="nav-link {{ request()->is('mahasiswa*') ? 'active' : '' }}">
                                <i class="fas fa-user-graduate nav-icon"></i>
                                <p>Kelola Mahasiswa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('dosen')}}"
                                class="nav-link {{ request()->is('dosen*') ? 'active' : '' }}">
                                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                <p>Kelola Dosen</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ request()->is('organisasi*') ||  request()->is('beasiswa*') ? 'menu-open' : '' }}">

                    <a href="#"
                        class="nav-link {{  request()->is('organisasi*') || request()->is('beasiswa*') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-history"></i>

                        <p>
                            Rekam Jejak Kegiatan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('/aktivitas') }}"
                                class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aktivitas dan Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/organisasi') }}"
                                class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Organisasi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}"
                                class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Beasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}"
                        class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informasi Beasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}"
                        class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informasi Lomba</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/pengajuan-surat') }}"
                        class="nav-link {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengajuan Surat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/referensi-tempat-kp') }}"
                        class="nav-link {{ request()->is('referensi-tempat-kp*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Referensi Tempat KP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}"
                        class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tracer Study</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/aduan') }}"
                        class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aduan</p>
                    </a>
                </li>
                @endrole


                <!-- END ROLE ADMIN -->


                <!-- ROLE MAHASISWA -->
                @role('Mahasiswa')
                <li class="nav-item has-treeview {{ request()->is('organisasi*') || request()->is('beasiswa*') ? 'menu-open' : '' }}">

                    <a href="#"
                        class="nav-link {{ request()->is('organisasi*') || request()->is('beasiswa*') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-history"></i>

                        <p>
                            Rekam Jejak Kegiatan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('aktivitas') }}"
                                class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Aktivitas dan Prestasi</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('organisasi') }}"
                                class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Organisasi</p>

                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}"
                                class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Beasiswa</p>

                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}"
                        class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informasi Lomba</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}"
                        class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informasi Beasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/pengajuan-surat') }}"
                        class="nav-link {{ request()->is('pengajuan-surat*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengajuan Surat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/konseling') }}"
                        class="nav-link {{ request()->is('konseling*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Konseling</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/referensi-tempat-kp') }}"
                        class="nav-link {{ request()->is('referensi-tempat-kp*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Referensi Tempat KP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/aduan') }}"
                        class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aduan</p>
                    </a>
                </li>
                @endrole
                <!-- ROLE END MAHASISWA -->


                <!-- ROLE KAJUR -->
                @role('Kajur')
                <li class="nav-item has-treeview {{ request()->is('organisasi*') ||  request()->is('beasiswa*') ? 'menu-open' : '' }}">

                    <a href="#"
                        class="nav-link {{  request()->is('organisasi*') || request()->is('beasiswa*') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-history"></i>

                        <p>
                            Rekam Jejak Kegiatan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('/aktivitas') }}"
                                class="nav-link {{ request()->is('aktivitas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aktivitas dan Prestasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/organisasi') }}"
                                class="nav-link {{ request()->is('organisasi*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Organisasi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('beasiswa') }}"
                                class="nav-link {{ request()->is('beasiswa*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Beasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/aduan') }}"
                        class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aduan</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}"
                        class="nav-link {{ request()->is('aduan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informasi Lomba</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}"
                        class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informasi beasiswa</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}"
                        class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tracer Study</p>
                    </a>
                </li>
                @endrole

                <!-- END ROLE KAJUR -->



                <!-- ROLE DOSEN KEMAHASISWAAN -->
                @role('DosenKemahasiswaan')
                <li class="nav-item">
                    <a href="{{ url('/info-lomba') }}"
                        class="nav-link {{ request()->is('info-lomba*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informasi Lomba</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-beasiswa') }}"
                        class="nav-link {{ request()->is('info-beasiswa*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Informasi Beasiswa</p>
                    </a>
                </li>
                @endrole
                <!-- END ROLE -->



                <!-- ROLE DOSEN -->
                @role('Dosen')
                <li class="nav-item">
                    <a href="{{ url('/konseling') }}"
                        class="nav-link {{ request()->is('konseling*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Konseling</p>
                    </a>
                </li>


                @endrole
                <!-- END ROLE DOSEN -->


                <!-- ROLE ALUMNI -->
                @role('Alumni')
                <li class="nav-item">
                    <a href="{{ url('/tracer-study') }}"
                        class="nav-link {{ request()->is('tracer-study*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tracer Study</p>
                    </a>
                </li>

                @endrole



                <!-- END ROLE ALUMNI -->

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">Logout</button>
                    </form>

                </li>


            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>