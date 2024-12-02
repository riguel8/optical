<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>Delin Optical</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/m.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

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
    <link rel="stylesheet" href="{{ asset('assets/css/contactus.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landingEyewear.css') }}">
    <style>
        .carousel img {
                height: 450px;
            }

        @media (max-width: 768px) {
            .carousel img {
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            .carousel img {
                height: 200px;
            }
        }

        /* About Section Styling */
        @media (max-width: 768px) {
            .about-images .img-fluid {
                margin: auto;
                width: 100%;
            }
        }

        /* Eyewear Section */
        @media (max-width: 768px) {
            #eyewearCarousel .carousel-inner {
                flex-direction: column;
            }
            .productset {
                margin-bottom: 15px;
            }
            #eyewears h2 {
            font-size: 1rem; /* Smaller "About" title */
            }
            #eyewears h1 {
                font-size: 1.2rem; /* Smaller main heading */
            }
            #eyewears p {
                font-size: 0.9rem; /* Smaller paragraph text */
            }
        }

        /* Services Section */
        @media (max-width: 768px) {
            #services .card {
                margin-bottom: 15px;
            }
            #services h2 {
            font-size: 1rem; /* Smaller "About" title */
            }
            #services h1 {
                font-size: 1.2rem; /* Smaller main heading */
            }
            #services p {
                font-size: 0.9rem; /* Smaller paragraph text */
            }
        }

        /* Contact Us Section */
        @media (max-width: 768px) {
            .contact-card {
                flex-direction: column;
            }
            .contact-details,
            .contact-form {
                width: 100%;
            }
            #contact h2 {
                font-size: 1.2rem; /* Smaller heading */
            }
            #contact h3 {
                font-size: 1rem; /* Smaller subheading */
            }
            #contact p, #contact ul, #contact label {
                font-size: 0.9rem; /* Smaller text size */
            }
            #contact .btn {
                font-size: 0.8rem; /* Smaller button text */
                padding: 0.4rem 1rem; /* Adjust button padding */
            }
        }
    

    /* Responsive Navbar Adjustments */
    @media (max-width: 768px) {
        .navbar {
            padding: 0.5rem;
        }

        .mobile-user-menu {
            display: block;
        }

        .collapse.navbar-collapse {
            display: none !important; /* Hide desktop menu */
        }

        .logo-img img {
            max-height: 50px;
        }

        .mobile-user-menu .btn {
            font-size: 0.75rem; /* Smaller font for narrow screens */
            padding: 0.3rem 0.5rem;
        }
    
        .mobile-user-menu iconify-icon {
            font-size: 1.25rem; /* Slightly smaller icon for narrow screens */
            }
    }

    /* Larger Screens */
    @media (min-width: 769px) {
        .mobile-user-menu {
            display: none;
        }
    }

    /* Mobile-specific adjustments for smaller text */
    @media (max-width: 768px) {
        #about h2 {
            font-size: 1rem; /* Smaller "About" title */
        }
        #about h1 {
            font-size: 1.2rem; /* Smaller main heading */
        }
        #about p {
            font-size: 0.9rem; /* Smaller paragraph text */
        }
        #about .btn {
            font-size: 0.70rem;
            padding: 0.1rem 0.1rem;
        }
    }

    /* Tablet-specific adjustments */
    @media (min-width: 769px) and (max-width: 992px) {
        #about h2 {
            font-size: 1.2rem; /* Moderate size for About title */
        }
        #about h1 {
            font-size: 1.8rem; /* Slightly larger heading */
        }
        #about p {
            font-size: 1rem; /* Adjust paragraph size */
        }
        #about .btn {
            padding: 0.6rem 1.2rem; /* Moderate padding for button */
        }
    }
    </style>
</head>
<body>

<header class="topheader py-0 sticky-top" id="top">
    <div class="landingpage">
        <div class="main-wrapper" id="home">
            <header class="topheader py-0 sticky-top" id="top">
                <div class="container">

                    @include('template.landing.navbar')

                </div>
            </header>

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
                                        <div class="input-group justify-content-end">
                                            <div class="btn" role="group">
                                                @foreach($questions as $question)
                                                    <button type="button" class="btn btn-outline-success m-1 question-btn rounded-pill mb-3" data-chatbot-id="{{ $question->ChatbotID }}">
                                                        {{ $question->Question }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input class="form-control type_msg mh-auto empty_check" placeholder="Type your message...">
                                            <button class="btn btn-primary btn_send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="text-center">
                <div class="container pt-4">
                    <section class="mb-10">
                        <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button" data-mdb-ripple-color="dark">
                            <i class="fab fa-facebook-f" style="color: #ff9f43;"></i>
                        </a>
                        <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                            <i class="fab fa-twitter" style="color: #ff9f43;"></i>
                        </a>
                        <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                            <i class="fab fa-google" style="color: #ff9f43;"></i>
                        </a>
                        <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                            <i class="fab fa-instagram" style="color: #ff9f43;"></i>
                        </a>
                        <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                            <i class="fab fa-linkedin" style="color: #ff9f43;"></i>
                        </a>
                        <a class="btn btn-link btn-floating btn-lg m-1" href="#!" role="button">
                            <i class="fab fa-github" style="color: #ff9f43;"></i>
                        </a>
                    </section>
                </div>
                <div class="text-center p-3">
                    <p>&copy; 2024 SoftDev, BSIT-4A. All Rights Reserved.</p>
                </div>
            </footer>

        </div>
    </div>
</header>



@yield('scripts')

<script src="{{ asset('assets/js/iconify-icon.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script> -->

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{ asset("assets/lib/wow/wow.min.js")}}"></script>
<script src="{{ asset("assets/lib/easing/easing.min.js")}}"></script>
<script src="{{ asset("assets/lib/waypoints/waypoints.min.js")}}"></script>
<script src="{{ asset("assets/lib/counterup/counterup.min.js")}}"></script>
<script src="{{ asset("assets/lib/owlcarousel/owl.carousel.min.js")}}"></script>
<script src="{{ asset("assets/lib/tempusdominus/js/moment.min.js")}}"></script>
<script src="{{ asset("assets/lib/tempusdominus/js/moment-timezone.min.js")}}"></script>
<script src="{{ asset("assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js")}}"></script>

<!-- Template Javascript -->
<script src="{{ asset("assets/lib/main.js")}}"></script>

<script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
<script src="extensions/fixed-columns/bootstrap-table-fixed-columns.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<script>
    document.querySelectorAll('.scroll-link').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        const target = document.querySelector(this.getAttribute('href'));
        target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
});

</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var introMessage = "Welcome to Delin Optical! How can we assist you today?";
    appendMessage('received', introMessage);

    document.querySelectorAll('.question-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var chatbotId = this.getAttribute('data-chatbot-id');
            var questionText = this.textContent;
            sendMessage(questionText, chatbotId);
        });
    });
});

function sendMessage(message, chatbotId) {
    const messageId = 'message-' + new Date().getTime(); 
    appendMessage('sent', message, messageId);

    scrollToMessage(messageId);

    setTimeout(function() {
        showTypingIndicator(messageId);

        setTimeout(function() {
            fetch('{{ route("fetchResponse") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ chatbot_id: chatbotId })
            })
            .then(response => response.json())
            .then(data => {
                removeTypingIndicator();
                appendMessage('received', data.answer, messageId);

                scrollToMessage(messageId);
            });
        }, 2000); 
    }, 1000); 
}
function showTypingIndicator(messageId) {
    var chatMessages = document.getElementById('chat-messages');
    
    if (!document.querySelector('.typing-indicator')) {
        var li = document.createElement('li');
        li.classList.add('media', 'received', 'd-flex', 'typing-indicator');
        li.id = messageId; 
        li.innerHTML = `
            <div class="avatar flex-shrink-0">
                <img src="assets/img/Dlogo-small.png" alt="Typing..." class="avatar-img rounded-circle">
            </div>
            <div class="media-body flex-grow-1">
                <div class="msg-box">
                    <div>
                        <div class="msg-typing">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        chatMessages.appendChild(li);
        scrollToMessage(messageId);
    }
}

function removeTypingIndicator() {
    var typingIndicator = document.querySelector('.typing-indicator');
    if (typingIndicator) {
        typingIndicator.remove();
    }
}

function appendMessage(type, message, messageId) {
    var chatMessages = document.getElementById('chat-messages');
    var li = document.createElement('li');
    li.classList.add('media', type === 'sent' ? 'sent' : 'received', 'd-flex');
    li.id = messageId;  
    li.innerHTML = `
        <div class="avatar flex-shrink-0">
            <img src="assets/img/users/${type === 'sent' ? 'noimages.jpg' : 'Dlogo-small.png'}" alt="User Image" class="avatar-img rounded-circle">
        </div>
        <div class="media-body flex-grow-1">
            <div class="msg-box">
                <div>
                    <p>${message}</p>
                    <ul class="chat-msg-info">
                        <li>
                            <div class="chat-time">
                                <span>${new Date().toLocaleTimeString()}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    `;
    chatMessages.appendChild(li);
}

function scrollToMessage(messageId) {
    var messageElement = document.getElementById(messageId);
    if (messageElement) {
        messageElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

document.getElementById('chatbotModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('chat-messages').innerHTML = '';
});
</script>

<script>
    var checkeventcount = 1,prevTarget;
        $('.modal').on('show.bs.modal', function (e) {
            if(typeof prevTarget == 'undefined' || (checkeventcount==1 && e.target!=prevTarget))
            {  
              prevTarget = e.target;
              checkeventcount++;
              e.preventDefault();
              $(e.target).appendTo('body').modal('show');
            }
            else if(e.target==prevTarget && checkeventcount==2)
            {
              checkeventcount--;
            }
         });
</script>

</body>
</html>


