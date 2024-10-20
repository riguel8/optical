<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/m.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">

    <title>Delin Optical</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/Dlogo-small.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/pe7/pe-icon-7.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/simpleline/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" >
    <link rel="stylesheet" href="{{ asset('assets/lib/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}">

    <style>
        .section-padding {
            padding-top: 10px;
        }

        .logo-img img {
            max-width: 150px;
            height: auto;
        }
        .sticky-top {
            position: sticky;
            top: 0;
            z-index: 1030;
            background-color: #fff; 
            width: 100%; 
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); 
        }

        html {
            scroll-behavior: smooth;
        }

        .productset {
            max-height: 400px; 
            overflow: hidden; 
            text-align: center; 
        }

        .productsetimg img {
            max-height: 300px; 
            object-fit: cover; 
            width: 100%; 
        }

        .productsetcontent {
            padding: 10px; 
        }

        .swiper-pagination {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .swiper-pagination-bullet {
            background-color: #637381;
            border: 2px solid white;
            border-radius: 50%;
            width: 14px;
            height: 14px;
            opacity: 0.7;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .swiper-pagination-bullet-active {
            background-color:#212b36;
            opacity: 1;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #212b36;
            border-radius: 50%;
        }
    </style>
</head>

