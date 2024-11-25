<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>{{ $title ?? 'Delin Optical' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/Dlogo-small.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Additional CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/alertify/alertify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/material/materialdesignicons.css')}}">

    <!-- FontAwesome and Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/pe7/pe-icon-7.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/simpleline/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contactus.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/appointmentcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/eyewearfilter.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/time-select.css') }}">
</head>
<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">
        <div class="header">
            <div class="header-left active">
                <a href="{{ url('dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/Dlogo.png') }}" alt="">
                </a>
                <a href="{{ url('dashboard') }}" class="logo-small">
                    <img src="{{ asset('assets/img/Dlogo-small.png') }}" alt="">
                </a>
                <a id="toggle_btn" href=""></a>
            </div>

            @include('template.client.navbar')

        </div>

            @include('template.client.sidebar')
            @yield('content')

            <!-- Floating Chat Button -->
            <a id="contactUsBtn" class="chat-float-btn mb-5" data-bs-toggle="modal" data-bs-target="#chatbotModal">
                <iconify-icon icon="simple-icons:chatbot" width="24" height="24" data-bs-toggle="tooltip" title="Chat with our Assistant"></iconify-icon>
                <!-- <span>Chat with our Assistant</span> -->
            </a>

            
    <div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatbotModalLabel">Chat with our Assistant</h5>
                    <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="row">
                            <div class="chat-window">
                                <div class="chat-cont-right">
                                    <div class="card mb-0">
                                        <div class="card-header msg_head">
                                            <div class="d-flex bd-highlight align-items-center">
                                                <a id="back_user_list" href="javascript:void(0)" class="back-user-list d-lg-none me-2">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                                <div class="img_cont">
                                                    <img class="rounded-circle user_img" src="{{ asset('assets/img/Dlogo-small.png') }}" alt="Chatbot Logo">
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
                                 
                                            <div class="d-flex justify-content-end">
                                                <div class="text-end">
                                                    @foreach($questions as $question)
                                                        <button type="button" class="btn btn-outline-success m-1 question-btn rounded-pill mb-3" data-chatbot-id="{{ $question->ChatbotID }}">
                                                            {{ $question->Question }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <input class="form-control type_msg mh-auto empty_check" placeholder="Type your message...">
                                                <button class="btn btn-primary btn_send">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

    <footer>
        <div class="p-2">
            <p>&copy; 2024 Software Development. All Rights Reserved.</p>
        </div>
    </footer>

    @yield('scripts')



<!-- jQuery and Bootstrap -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Additional JS -->
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/bs-init.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset("assets/js/showmodal.js")}}"></script>

<script>
// Helper function to create status badge
function getStatusBadge(status) {
    var badgeClass;
    var statusText;

    // Determine the badge class and text based on status
    switch (status) {
        case 'Pending':
            badgeClass = 'bg-lightyellow badges';
            statusText = 'Pending';
            break;
        case 'Confirm':
            badgeClass = 'bg-lightgreen badges';
            statusText = 'Confirm';
            break;
        case 'Cancelled':
            badgeClass = 'bg-lightred badges';
            statusText = 'Cancelled';
            break;
        default:
            badgeClass = '';
            statusText = status;
            break;
    }

    // Return the HTML string for the badge
    return `<span class="${badgeClass}">${statusText}</span>`;
}
</script>

<script>
$(document).ready(function() {
    $('#addAppointmentForm').submit(function(e) {
        e.preventDefault(); 
        
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'New appointment was added successfully',
                        confirmButtonColor: '#ff9f43',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ url('/client/appointments') }}";
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add appointment: ' + response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request. Please try again later.'
                });
            }
        });
    });
});
</script>

<script>
    // Restore filter state from local storage on page load
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.filter-group').forEach(function (group) {
            const toggle = group.querySelector('.filter-toggle');
            const collapseElement = group.querySelector('.collapse');
            const symbol = toggle.querySelector('.toggle-symbol');
            const filterId = collapseElement.id;

            // Check local storage for the state of this filter
            const isExpanded = localStorage.getItem(filterId) === 'true';

            if (isExpanded) {
                collapseElement.classList.add('show');
                symbol.textContent = '-';
            } else {
                collapseElement.classList.remove('show');
                symbol.textContent = '+';
            }

            // Set up the click event listener for toggling
            toggle.addEventListener('click', function () {
                const isCurrentlyExpanded = collapseElement.classList.contains('show');

                // Toggle the state
                if (isCurrentlyExpanded) {
                    collapseElement.classList.remove('show');
                    symbol.textContent = '+';
                    localStorage.setItem(filterId, 'false');
                } else {
                    collapseElement.classList.add('show');
                    symbol.textContent = '-';
                    localStorage.setItem(filterId, 'true');
                }
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
                <img src="{{ asset("assets/img/Dlogo-small.png")}}" alt="Typing..." class="avatar-img rounded-circle">
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
            <img src="${window.location.origin + '/assets/img/users/' + (type === 'sent' ? 'noimages.jpg' : 'Dlogo-small.png')}" alt="User Image" class="avatar-img rounded-circle">
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
</body>
</html>

