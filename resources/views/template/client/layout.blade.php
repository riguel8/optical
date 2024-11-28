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
    <link rel="stylesheet" href="{{ asset('assets/css/chat-tab.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
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
</a>

<!-- Chat Modal -->
<div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatbotModalLabel">Chat with our Assistant</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="chat-window">
                    <div class="card mb-0">
                        <div class="chat-box">
                        </div>
                        <div class="card-footer">
                            <div class="input-group">
                                <input id="messageInput" class="form-control type_msg mh-auto empty_check" placeholder="Type your message..." />
                                <button id="sendButton" class="btn btn-primary btn_send">
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


<script src="https://js.pusher.com/8.4/pusher.min.js"></script>
<script>
    window.CURRENT_USER_ID = @json(auth()->id());
</script>
<script src="{{ asset('assets/js/staff/chats/chatting-system.js') }}"></script>





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
<!-- <script src="{{ asset('assets/js/iconify-icon.min.js') }}"></script> -->
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

