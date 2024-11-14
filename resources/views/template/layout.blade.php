<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/m.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

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
    <link rel="stylesheet" href="{{ asset('assets/css/landingEyewear.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contactus.css') }}">
</head>
<body>

  @yield('content')

  <div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatbotModalLabel">Chat with our Assistant</h5>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-7 col-xl-12 chat-cont-right">
                    <div class="card mb-0">
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight">
                                <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <div class="img_cont">
                                    <img class="rounded-circle user_img" src="{{ asset('assets/img/Dlogo-small.png') }}" alt="">
                                </div>
                                <div class="user_info">
                                    <span><strong id="receiver_name">Delin Optical</strong></span>
                                    <p class="mb-0">Chatbot</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body msg_card_body chat-scroll">
                            <ul class="list-unstyled" id="chat-messages"></ul>
                        </div>
                        <div class="card-footer">
                            <div class="input-group">
                                <div class="btn" role="group">
                                    <button type="button" class="btn btn-outline-success" onclick="sendMessage('Book an Appointment')">Book an Appointment</button>
                                    <button type="button" class="btn btn-outline-primary" onclick="sendMessage('What are the available hours for today?')">Available Hours Today</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
