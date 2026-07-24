<nav class="main-header navbar navbar-expand navbar-white navbar-light d-flex justify-content-between align-items-center px-5 py-2">

    <!-- SISI KIRI HEADER: Foto / Silhouette & Nama Jabatan Berdasarkan Peran (Role) -->
    <div class="d-flex flex-column align-items-center text-center mt-2" style="width: 180px;">
        @if(auth()->user()->hasRole('Admin'))
        <img src="{{ asset('images/admin.png') }}"
            onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Admin';"
            alt="Admin SIMAFO"
            class="img-fluid mb-1"
            style="height: 65px; width: auto; object-fit: contain;">
        <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.9rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
            Admin
        </span>

        @elseif(auth()->user()->hasRole('Kajur'))
        <img src="{{ asset('images/ketua-jurusan.png') }}"
            onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Kajur';"
            alt="Ketua Jurusan"
            class="img-fluid mb-1"
            style="height: 65px; width: auto; object-fit: contain;">
        <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.9rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
            Ketua Jurusan
        </span>

        @elseif(auth()->user()->hasRole('DosenKemahasiswaan'))
        <img src="{{ asset('images/dosen-kemahasiswaan.png') }}"
            onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Dosen+Kemhs';"
            alt="Dosen Kemahasiswaan"
            class="img-fluid mb-1"
            style="height: 65px; width: auto; object-fit: contain;">
        <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.8rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
            Dosen Kemahasiswaan
        </span>


        @elseif(auth()->user()->hasRole('Dosen'))
        <img src="{{ asset('images/dosen.png') }}"
            onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Dosen';"
            alt="Dosen"
            class="img-fluid mb-1"
            style="height: 65px; width: auto; object-fit: contain;">
        <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.9rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
            Dosen
        </span>

        @elseif(auth()->user()->hasRole('alumni'))
        <img src="{{ asset('images/alumni.png') }}"
            onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Alumni';"
            alt="Alumni"
            class="img-fluid mb-1"
            style="height: 65px; width: auto; object-fit: contain;">
        <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.9rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
            Alumni
        </span>

        @elseif(auth()->user()->hasROle('Mahasiswa'))
        <img src="{{ asset('images/mahasiswa.png') }}"
            onerror="this.onerror=null; this.src='https://placehold.co/100x100/ffffff/000000?text=Mhs';"
            alt="Mahasiswa"
            class="img-fluid mb-1"
            style="height: 65px; width: auto; object-fit: contain;">
        <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.9rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
            Mahasiswa
        </span>
        @else
        <!-- Default Tampian jika tidak terautentikasi (Guest) -->
        <img src="https://placehold.co/100x100/ffffff/000000?text=Guest"
            alt="Guest"
            class="img-fluid mb-1"
            style="height: 65px; width: auto; object-fit: contain;">
        <span class="font-weight-black text-dark text-uppercase" style="font-weight: 850; font-size: 0.9rem; letter-spacing: 0.5px; font-family: 'Arial Black', sans-serif;">
            SIMAFO USER
        </span>
        @endif
    </div>

    <!-- SISI KANAN HEADER: Simafo Colorful Logo & Deskripsi -->
    <div class="d-flex flex-column align-items-end justify-content-center text-right pr-3">
        <div class="d-flex align-items-center mb-1">
            <img src="{{ asset('images/logo-simafo.png') }}"
                onerror="this.onerror=null; this.src='https://placehold.co/120x45/ffffff/000000?text=Simafo+Logo';"
                alt="Simafo Logo"
                class="img-fluid"
                style="height: 52px; width: auto; object-fit: contain;">
        </div>
        <p class="text-dark m-0 font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 1px; line-height: 1.3; font-family: 'Arial', sans-serif; opacity: 0.9;">
            Sistem Informasi Mahasiswa
        </p>
    </div>

</nav>