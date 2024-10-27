<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="dark" data-color-theme="Red_Theme" data-layout="vertical">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/Dlogo-small.png') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/styles.css') }}" />

    <title>@yield('title')</title>
</head>
<style>
    .auth-card {
        max-width: 600px;
        margin: auto;
    }

    .logo-img {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .logo-img img {
        max-width: 200px;
        height: auto;
    }
    .input-icon {
            position: relative;
        }
        .input-icon input {
            padding-right: 30px; 
        }
        .input-icon i {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
        }
</style>
<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>
    
    @yield('content')
    
    <!-- JavaScript files -->
    <script src="{{asset('assets/js/password.js')}}"></script>
    <script src="{{ asset('assets/landing/js/app.dark.init.js') }}"></script>
    <script src="{{ asset('assets/landing/libs/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/app.init.js') }}"></script>
    <script src="{{ asset('assets/landing/css/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing/libs/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/landing/libs/js/iconify-icon.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/landing/js/theme.js') }}"></script>
    <script src="{{ asset('assets/landing/js/feather.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/plugins/alertify/alertify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/alertify/custom-alertify.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
</body>
</html>
