
document.addEventListener('DOMContentLoaded', function () {
    const chatModal = document.getElementById('chatbotModal');
    const messagesContainer = document.querySelector('.chat-box');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    // const CURRENT_USER_ID = {{ json_encode(auth()->id()) }};
    let currentConversationId = null;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const pusher = new Pusher('df502c6246876de7e65d', {
        cluster: 'ap1',
        encrypted: true,
    });

    function fetchConversation() {
        fetch(`/client/conversation/${CURRENT_USER_ID}`)
            .then(response => response.json())
            .then(data => {
                if (data.conversation_id) {
                    currentConversationId = data.conversation_id;
                    fetchMessages(currentConversationId);
                } else {
                    console.log("No conversation found for the user.");
                }
            })
            .catch(error => console.error('Error fetching conversation:', error));
    }

    function fetchMessages(conversationId) {
        fetch(`/client/conversation/${conversationId}/messages`) 
            .then(response => response.json())
            .then(messages => {
                messagesContainer.innerHTML = ''; 
                messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message');

                    if (message.sender_id === CURRENT_USER_ID) {
                        messageElement.classList.add('sent');
                    } else {
                        messageElement.classList.add('received');
                    }
                    
                    messageElement.innerHTML = `
                        <strong>${message.sender.name}</strong>: 
                        <p>${message.message}</p>
                        <span class="timestamp">
                            ${new Date(message.created_at).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true })}
                        </span>
                    `;

                    messagesContainer.appendChild(messageElement);
                });
            })
            .catch(error => console.log('Error fetching messages:', error));
    }

    function sendMessage(conversationId, messageText) {
        fetch(`/client/conversation/${conversationId}/send-message`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ message: messageText })
        })
        .then(response => response.json())
        .then(message => {
            displaySentMessage(message);
        })
        .catch(error => console.log('Error sending message:', error));
    }
    function displaySentMessage(message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'sent');

        messageElement.innerHTML = `
            <strong>${message.sender_name}</strong>: 
            <p>${message.message}</p>
            <span class="timestamp">${message.created_at}</span>
        `;

        messagesContainer.appendChild(messageElement);
    }

    sendButton.addEventListener('click', function () {
        const messageText = messageInput.value;
        if (messageText) {
            sendMessage(currentConversationId, messageText);
        }
    });
    messageInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            const messageText = messageInput.value;
            if (messageText) {
                sendMessage(currentConversationId, messageText);
            }
        }
    });

    const channel = pusher.subscribe('chat.' + CURRENT_USER_ID);
    channel.bind('MessageSent', function(data) {
        const message = data.message;
        const senderName = data.sender_name;
        const createdAt = data.created_at;

        const newMessage = document.createElement('li');
        newMessage.classList.add('message', 'chatmate');
        newMessage.textContent = `${senderName}: ${message} (${createdAt})`;
        messagesContainer.appendChild(newMessage);

        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    });

    fetchConversation();
});
