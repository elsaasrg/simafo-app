<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Informasi Kemahasiswaan - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 0;
            /* Membuat porsi tampilan penuh di layar monitor */
            box-shadow: none;
            overflow: hidden;
            width: 100%;
            min-height: 100vh;
            border: none;
        }

        /* Split screen structure */
        .login-row {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        /* Left side styling (White form) */
        .login-form-side {
            flex: 1;
            padding: 3rem 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
        }

        /* Right side styling (Lime green info dengan warna #CFE561) */
        .login-info-side {
            flex: 1;
            background-color: #CFE561;
            padding: 3rem 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .login-info-side {
                display: none;
                /* Menyembunyikan sisi informasi di layar handphone */
            }

            .login-form-side {
                padding: 2.5rem 1.5rem;
            }
        }

        /* Form elements styles */
        .input-group-custom {
            background-color: #f3f4f6;
            border-radius: 8px;
            padding: 4px 12px;
            display: flex;
            align-items: center;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .input-group-custom:focus-within {
            background-color: #ffffff;
            border-color: #CFE561;
            box-shadow: 0 0 0 3px rgba(207, 229, 97, 0.25);
        }

        .input-group-custom i {
            color: #6b7280;
            font-size: 1.1rem;
            margin-right: 10px;
        }

        .input-group-custom input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            padding: 8px 0;
            font-size: 0.95rem;
            color: #374151;
        }

        .input-group-custom input::placeholder {
            color: #9ca3af;
        }

        .field-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: #111111;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        /* Lime Green Login Button menggunakan warna #CFE561 */
        .btn-login-lime {
            background-color: #CFE561;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 1px;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            width: 100%;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(207, 229, 97, 0.35);
            text-transform: uppercase;
        }

        .btn-login-lime:hover {
            background-color: #b8cc4f;
            /* Warna hover sedikit lebih gelap untuk kontras */
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(207, 229, 97, 0.45);
        }

        .btn-login-lime:active {
            transform: translateY(1px);
        }

        /* Text teal links */
        .teal-link {
            color: #32c5ad;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .teal-link:hover {
            color: #269d8a;
            text-decoration: underline;
        }

        /* Dot Indicators */
        .carousel-dots {
            display: flex;
            gap: 8px;
            margin-top: 25px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 2px solid #ffffff;
            background-color: transparent;
            transition: all 0.2s;
        }

        .dot.active {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-row">

            <!-- LEFT SIDE: WHITE FORM PANEL (Netral untuk semua pengguna) -->
            <div class="login-form-side">

                <!-- Brand / Heading Header -->
                <!-- <div class="text-center mb-5">
                    <h3 class="fw-bold text-dark m-0" style="font-size: 2.1rem; letter-spacing: 0.5px;">SIMAFO</h3>
                    <p class="text-muted small">Sistem Informasi Kemahasiswaan</p>
                </div> -->

                <form method="POST" action="{{ route('login') }}" class="px-md-4">
                    @csrf

                    <!-- Username / Email Field -->
                    <div class="mb-4">
                        <label for="email" class="field-label">Email</label>
                        <div class="input-group-custom">
                            <i class="bi bi-person-fill"></i>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukan email anda di sini..." autofocus>
                        </div>
                        @error('email')
                        <span class="text-danger small mt-1 d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-5">
                        <label for="password" class="field-label">Password</label>
                        <div class="input-group-custom">
                            <i class="bi bi-lock-fill"></i>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukan password anda di sini...">
                            <!-- Password Toggle Eye Icon -->
                            <i class="bi bi-eye-slash" id="togglePasswordIcon" style="cursor: pointer; margin-left: 10px; margin-right: 0;" onclick="togglePasswordVisibility()"></i>
                        </div>
                        @error('password')
                        <span class="text-danger small mt-1 d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn-login-lime">
                            Log In
                        </button>
                    </div>

                    <!-- Forgot link -->
                    <!-- <div class="text-center">
                        @if (Route::has('password.request'))
                        <a class="teal-link" href="{{ route('password.request') }}">
                            Lupa Username/Password?
                        </a>
                        @else
                        <a class="teal-link" href="#">
                            Lupa Username/Password?
                        </a>
                        @endif
                    </div> -->
                </form>
            </div>

            <!-- RIGHT SIDE: LIME GREEN INFORMATION PANEL -->
            <div class="login-info-side">

                <!-- Image Container (Pengguna dapat mengganti isi login-illustration.png di folder public/images/) -->
                <div class="illustration-container mb-4 d-flex justify-content-center" style="width: 100%; max-width: 380px;">
                    <img src="{{ asset('images/login-illustration.png') }}"
                        onerror="this.onerror=null; this.src='https://placehold.co/380x280/CFE561/ffffff?text=SIMAFO+Illustration';"
                        class="img-fluid"
                        alt="SIMAFO Illustration"
                        style="max-width: 100%; height: auto; border-radius: 12px; object-fit: contain;">
                </div>

                <!-- Description Text -->
                <p class="m-0 fw-bold px-4" style="font-size: 0.9rem; line-height: 1.6; text-align: center; opacity: 0.95;">
                    SIMAFO merupakan sistem informasi mahasiswa forte. Forte memiliki makna "kekuatan" atau "keunggulan", yang mencerminkan sistem informasi kemahasiswaan yang andal, efektif, dan terintegrasi.
                </p>

                <!-- Dots Carousel indicator layout -->
                <div class="carousel-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>

        </div>
    </div>

    <!-- Password Visibility Toggle Script -->
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>

</html>