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
			padding-right: 30px; /* Adjust this value based on the icon size */
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
    @yield('content')
