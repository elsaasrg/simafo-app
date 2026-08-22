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

    <link rel="stylesheet" href="{{ asset('css/style-utama.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.component.navbar')

        <!-- Main Sidebar Container -->
        @include('layouts.component.aside_baru')

        <!-- Overlay Layar Gelap Saat Sidebar Terbuka di HP -->
        <div id="sidebar-overlay" data-widget="pushmenu"></div>

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

            // 4. OTOMATIS TUTUP SIDEBAR SAAT LINK MENU DIKLIK PADA LAYAR MOBILE
            $(document).on('click', '.main-sidebar .nav-link', function() {
                var hrefAttr = $(this).attr('href');
                // Hanya tutup jika link tersebut mengarahkan ke halaman baru (bukan dropdown folder)
                if ($(window).width() <= 991 && hrefAttr !== '#' && hrefAttr !== '' && hrefAttr !== undefined) {
                    $('body').removeClass('sidebar-open').addClass('sidebar-closed sidebar-collapse');
                }
            });
        });
    </script>

    @stack('js')
</body>

</html>