<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">

    <style>
        /* Mengubah warna dasar latar belakang aplikasi sesuai desain */
        body {
            background-color: #EBEBEB !important;
        }

        /* border radius */
        .btn-radius {
            border-radius: 12px;
        }

        .btn-radius-2 {
            border-radius: 15px !important;
        }

        /* background */
        .bg-kuning-1 {
            background-color: #F9E98C;
        }

        .bg-kuning-2 {
            background-color: #E4FF8C;
        }

        .bg-kuning-3 {
            background-color: #F8F8C9;
        }

        .bg-kuning-4 {
            background-color: #CFE561;
        }

        .bg-abu-abu {
            background-color: #5B5455;
        }

        .border-kuning {
            border: 2px solid #CFE561;
        }

        /* Memposisikan Header Utama agar membentang 100% penuh di bagian atas */
        .main-header {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            width: 100% !important;
            height: 140px !important;
            margin-left: 0 !important;
            z-index: 1035 !important;
            background-color: #ffffff !important;
            border-bottom: 2px solid #e2e8f0 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05) !important;
        }

        /* Menyejajarkan Letak & Warna Dasar Sidebar Utama */
        .main-sidebar {
            position: fixed !important;
            top: 140px !important;
            height: calc(100vh - 140px) !important;
            width: 290px !important;
            background-color: #CFE561 !important;

            border-right: 1px solid #d4e09b !important;
            z-index: 1030 !important;
        }

        /* Menyejajarkan Area Konten Utama */
        .content-wrapper {
            margin-top: 140px !important;
            margin-left: 280px !important;
            min-height: calc(100vh - 140px) !important;
            background-color: #EBEBEB !important;
            /* Latar abu-abu kontras di sisi kanan */
            padding: 30px !important;
        }

        /* Menyembunyikan elemen default AdminLTE */
        .main-sidebar .brand-link,
        .main-sidebar .user-panel {
            display: none !important;
        }

        .modal-header-kuning {
            background-color: #E4FF8C;
        }

        .modal-text-hitam {
            color: #000;
        }

        .card-shadow-inset {
            box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.component.navbar')

        <!-- Main Sidebar Container -->
        @include('layouts.component.aside_baru')

        <div class="content-wrapper">
            @yield('content')
        </div>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

    </div>

    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>

    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.js')}}"></script>

    <script>
        // previous page should be reloaded when user navigate through browser navigation 
        // for mozilla 
        window.onunload = function() {};

        // for chrome 
        if (window.performance && window.performance.navigation.type ===
            window.performance.navigation.TYPE_BACK_FORWARD) {
            location.reload();
        }
    </script>

    <script>
        $(document).ready(function() {
            const url = window.location;

            // 1. Menandai link yang aktif berdasarkan URL saat ini
            $('ul.nav-sidebar a').filter(function() {
                return this.href == url;
            }).addClass('active').parent().addClass('active');

            // 2. Otomatis membuka menu induk (dropdown) jika halaman di dalamnya sedang aktif saat reload
            $('ul.nav-treeview a').filter(function() {
                    return this.href == url;
                }).addClass('active')
                .closest('.has-treeview')
                .addClass('menu-open')
                .find('> .nav-treeview')
                .show();

            // 3. JQUERY DROPDOWN FALLBACK (Menjamin 100% dropdown terbuka saat diklik)
            $(document).on('click', '.has-treeview > a', function(e) {
                var hrefAttr = $(this).attr('href');

                // Jalankan toggler hanya jika link mengarah ke "#" atau kosong (link folder menu)
                if (hrefAttr === '#' || hrefAttr === '' || hrefAttr === undefined) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation(); // PENGAMAN: Hentikan script AdminLTE agar tidak memantulkan menu!

                    var $parent = $(this).parent('.has-treeview');
                    var $treeview = $parent.find('> .nav-treeview');

                    if ($parent.hasClass('menu-open')) {
                        // Jika sedang terbuka, slide up lalu hapus class menu-open
                        $treeview.slideUp(250, function() {
                            $parent.removeClass('menu-open');
                        });
                    } else {
                        // Tutup menu dropdown lain terlebih dahulu agar rapi (efek akordeon)
                        $('.has-treeview.menu-open').not($parent).each(function() {
                            $(this).find('> .nav-treeview').slideUp(200);
                            $(this).removeClass('menu-open');
                        });

                        // Slide down menu yang diklik lalu tambahkan class menu-open
                        $parent.addClass('menu-open');
                        $treeview.slideDown(250);
                    }
                }
            });
        });
    </script>

    @stack('js')
</body>

</html>