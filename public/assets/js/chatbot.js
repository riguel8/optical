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
