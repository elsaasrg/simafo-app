<nav class="main-header navbar navbar-expand navbar-white navbar-light d-flex justify-content-between align-items-center px-3 px-md-5 py-2">

    <!-- SISI KIRI HEADER: Tombol Burger Menu & Foto Profile/Role -->
    <div class="d-flex align-items-center">
        <!-- TOMBOL BURGER MENU -->
        <ul class="navbar-nav mr-2 mr-md-3 d-lg-none">
            <li class="nav-item">
                <a class="nav-link text-dark p-2" data-widget="pushmenu" href="#" role="button" style="font-size: 1.5rem;">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Foto / Silhouette & Nama Jabatan Berdasarkan Peran (Role) -->
        <div class="d-flex flex-column align-items-center text-center mt-2" style="width: 140px;">
            @if(auth()->user()->hasRole('Admin'))
            <img src="{{ asset('images/admin.png') }}"
                onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Admin';"
                alt="Admin SIMAFO"
                class="img-fluid mb-1"
                style="height: 55px; width: auto; object-fit: contain;">
            <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.85rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
                Admin
            </span>

            @elseif(auth()->user()->hasRole('Kajur'))
            <img src="{{ asset('images/ketua-jurusan.png') }}"
                onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Kajur';"
                alt="Ketua Jurusan"
                class="img-fluid mb-1"
                style="height: 55px; width: auto; object-fit: contain;">
            <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.85rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
                Ketua Jurusan
            </span>

            @elseif(auth()->user()->hasRole('DosenKemahasiswaan'))
            <img src="{{ asset('images/dosen-kemahasiswaan.png') }}"
                onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Dosen+Kemhs';"
                alt="Dosen Kemahasiswaan"
                class="img-fluid mb-1"
                style="height: 55px; width: auto; object-fit: contain;">
            <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.75rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
                Dosen Kemahasiswaan
            </span>

            @elseif(auth()->user()->hasRole('Dosen'))
            <img src="{{ asset('images/dosen.png') }}"
                onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Dosen';"
                alt="Dosen"
                class="img-fluid mb-1"
                style="height: 55px; width: auto; object-fit: contain;">
            <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.85rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
                Dosen
            </span>

            @elseif(auth()->user()->hasRole('Alumni'))
            <img src="{{ asset('images/alumni.png') }}"
                onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Alumni';"
                alt="Alumni"
                class="img-fluid mb-1"
                style="height: 55px; width: auto; object-fit: contain;">
            <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.85rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
                Alumni
            </span>

            @elseif(auth()->user()->hasRole('Mahasiswa'))
            <img src="{{ asset('images/mahasiswa.png') }}"
                onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Mhs';"
                alt="Mahasiswa"
                class="img-fluid mb-1"
                style="height: 55px; width: auto; object-fit: contain;">
            <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.85rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
                Mahasiswa
            </span>
            @else
            <img src="https://placehold.co/100x100/ffffff/000000?text=Guest"
                alt="Guest"
                class="img-fluid mb-1"
                style="height: 55px; width: auto; object-fit: contain;">
            <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.85rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
                SIMAFO USER
            </span>
            @endif
        </div>
    </div>

    <!-- SISI TENGAH HEADER: Teks Judul (Sembunyi otomatis di HP/Mobile via d-none d-lg-block) -->
    <div style="font-size:22px; font-family:Rowdies" class="color-yellow-4 text-center d-none d-lg-block">
        Sistem Informasi Mahasiswa Forte. <br>
        Satu portal, untuk kemahasiswaan
    </div>

    <!-- SISI KANAN HEADER: Logo SIMAFO -->
    <div class="d-flex flex-column align-items-end justify-content-center text-right pr-2">
        <div class="d-flex align-items-center mb-1">
            <img src="{{ asset('images/logo-sisfo.png') }}"
                onerror="this.onerror=null; this.src='https://placehold.co/120x45/ffffff/000000?text=Simafo+Logo';"
                alt="Simafo Logo"
                class="img-fluid"
                style=" width: auto; object-fit: contain;">
        </div>
    </div>

</nav>