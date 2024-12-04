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
    <link rel="stylesheet" href="{{ asset('assets/css/landing-mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chat-bot.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing-dr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing-footer.css') }}">

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

            <a id="contactUsBtn" class="chat-float-btn" data-bs-toggle="modal" data-bs-target="#chatbotModal">
                <iconify-icon icon="simple-icons:chatbot" width="24" height="24"  data-bs-toggle="tooltip" title="Chat with our Assistant"></iconify-icon>
            </a>

            <div class="modal fade" id="chatbotModal" tabindex="1" aria-labelledby="chatbotModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-dialog-right">
                    <div class="modal-content">

                        <div class="chat-header">
                            <div class="d-flex align-items-center">
                                <div class="img_cont me-2">
                                    <img src="{{ asset('assets/img/Dlogo-small.png') }}" alt="Bot" class="rounded-circle" width="40">
                                </div>
                                <div class="user_info">
                                    <h6>Delin Chatbot</h6>
                                </div>
                            </div>
                            <button class="btn btn-icon" type="button" data-bs-dismiss="modal">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>

                        <div class="chat-body" id="chat-container">
                            <ul class="list-unstyled" id="chat-messages"></ul>
                        </div>

                        <div class="chat-footer">
                            <div id="suggestions-area" class="mb-3">
                                <div class="suggestions-container">

                                </div>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control type_msg" placeholder="Coming soon..." disabled>
                                <button class="btn btn-send" disabled>
                                    <i class="fa fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="extensions/fixed-columns/bootstrap-table-fixed-columns.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="{{ asset("assets/js/showmodal.js")}}"></script>

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
    resetChat();

    document.getElementById('chatbotModal').addEventListener('hidden.bs.modal', function () {
        resetChat();
    });
});
let currentSuggestions = new Set();

function resetChat() {
    const chatMessages = document.getElementById('chat-messages');
    chatMessages.innerHTML = '';
    currentSuggestions.clear();
    
    const introMessage = "Welcome to Delin Optical! How can we assist you today?";
    appendMessage('received', introMessage);

    // Fetch first 3 questions
    fetch('{{ route("getInitialQuestions") }}')
        .then(response => response.json())
        .then(data => {
            updateSuggestionButtons(data);
        });
}

function sendMessage(message, chatbotId = null) {
    const messageId = 'message-' + new Date().getTime();
    
    // Hide only the clicked suggestion
    const clickedButton = document.querySelector(`[data-chatbot-id="${chatbotId}"]`);
    if (clickedButton) {
        clickedButton.style.opacity = '0';
        setTimeout(() => clickedButton.remove(), 300);
    }
    
    appendMessage('sent', message, messageId);
    scrollToBottom();

    setTimeout(() => {
        showTypingIndicator(messageId);
        scrollToBottom();
        
        setTimeout(() => {
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
                
                // Update suggestions
                if (data.related_questions && data.related_questions.length > 0) {
                    updateSuggestionButtons(data.related_questions);
                } else {
                    // If no new questions, reset to initial
                    fetch('{{ route("getInitialQuestions") }}')
                        .then(response => response.json())
                        .then(data => {
                            updateSuggestionButtons(data);
                        });
                }
                
                scrollToBottom();
            });
        }, 1500);
    }, 300);
}

function updateSuggestionButtons(questions) {
    const container = document.querySelector('.suggestions-container');
    container.innerHTML = '';
    
    if (questions.length === 0) {
        const noSuggestionsMessage = document.createElement('div');
        noSuggestionsMessage.className = 'no-suggestions';
        noSuggestionsMessage.textContent = 'No suggestion questions available.';
        container.appendChild(noSuggestionsMessage);
        return;
    }
    
    questions.forEach(question => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'suggestion-btn';
        button.setAttribute('data-chatbot-id', question.ChatbotID);
        button.textContent = question.Question;
        
        button.addEventListener('click', function() {
            sendMessage(question.Question, question.ChatbotID);
        });
        
        container.appendChild(button);
    });
}
function scrollToBottom() {
    const chatContainer = document.getElementById('chat-container');
    const lastMessage = chatContainer.lastElementChild;
    
    if (lastMessage) {
        const containerHeight = chatContainer.clientHeight;
        const messageBottom = lastMessage.offsetTop + lastMessage.offsetHeight;
        const scrollTop = messageBottom - containerHeight;
        
        chatContainer.scrollTo({
            top: scrollTop,
            behavior: 'smooth'
        });
    }
}
function showTypingIndicator(messageId) {
    var chatMessages = document.getElementById('chat-messages');
    
    if (!document.querySelector('.typing-indicator')) {
        var li = document.createElement('li');
        li.classList.add('media', 'received', 'd-flex', 'typing-indicator');
        li.id = messageId; 
        li.innerHTML = `
            <div class="avatar flex-shrink-0">
                <img src="{{ asset('assets/img/Dlogo-small.png')}}" alt="Typing..." class="avatar-img rounded-circle">
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
        scrollToBottom();
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

    const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    li.innerHTML = `
        ${type === 'received' ? `
        <div class="avatar flex-shrink-0">
            <img src="{{ asset('assets/img/Dlogo-small.png') }}" alt="Bot" class="rounded-circle" width="30">
        </div>` : ''}
        <div class="msg-box">
            <p class="mb-1">${message}</p>
            <small class="text-muted">${time}</small>
        </div>
        ${type === 'sent' ? `
        <div class="avatar flex-shrink-0">
            <img src="{{ asset('assets/img/users/noimages.jpg') }}" alt="User" class="rounded-circle" width="30">
        </div>` : ''}
    `;
    
    chatMessages.appendChild(li);
    chatMessages.scrollTop = chatMessages.scrollHeight;
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


