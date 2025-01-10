
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


