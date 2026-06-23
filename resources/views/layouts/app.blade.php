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
        /* 1. Mengubah background sidebar & area logo menjadi Ungu Tua yang Elegan */
        .main-sidebar,
        .brand-link {
            background-color: #4c1d95 !important;
            /* Warna Ungu Tua (Telemagenta/Violet) */
        }

        /* 2. Mengubah warna background area profil user agar sedikit lebih gelap */
        .user-panel {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        /* 3. Mengubah warna teks menu mahasiswa menjadi putih abu-abu agar tidak silau */
        .main-sidebar .nav-link {
            color: #f3e8ff !important;
            /* Ungu sangat muda hampir putih */
        }

        /* 4. Warna saat menu disorot (Hover) menjadi ungu medium */
        .main-sidebar .nav-item:hover>.nav-link {
            background-color: #6d28d9 !important;
            color: #ffffff !important;
        }

        /* 5. Warna saat menu tersebut AKTIF / diklik (Ungu Terang) */
        .main-sidebar .nav-pills .nav-link.active,
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
            background-color: #a855f7 !important;
            /* Ungu terang cerah */
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(168, 85, 247, 0.4);
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

        @include('layouts.component.footer')

        <aside class="control-sidebar control-sidebar-dark">

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
    <script
        src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{asset('assets/dist/js/demo.js')}}"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="{{asset('assets/dist/js/pages/dashboard.js')}}"></script> -->

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
            $('ul.nav-sidebar a').filter(function() {
                return this.href == url;
            }).parent().addClass('active');
            $('ul.nav-treeview a').filter(function() {

                return this.href == url;
            }).parentsUntil(".sidebar-menu > .nav-treeview").addClass('menu-open');

            $('ul.nav-treeview a').filter(function() {
                return this.href == url;
            }).addClass('active');

            $('li.has-treeview a').filter(function() {
                return this.href == url;
            }).addClass('active');

            $('ul.nav-treeview a').filter(function() {
                return this.href == url;
            }).parentsUntil(".sidebar-menu > .nav-treeview").children(0).addClass('active');

        });
    </script>


    @stack('js')
</body>

</html>