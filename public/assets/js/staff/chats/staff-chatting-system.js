document.addEventListener('DOMContentLoaded', function () {
    const chatModal = document.getElementById('chatModal');
    const messageContainer = document.getElementById('messageContainer');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const closeChatModal = document.getElementById('closeChatModal');
    const modalHeader = document.querySelector('.chat-header span');
    // const CURRENT_USER_ID = {{ json_encode(auth()->id()) }};
    
    let currentConversationId = null;
    let pusher = null;
    let channel = null;
    let currentSenderName = null;
    
    function toggleChatModal() {
        chatModal.classList.toggle('active');
    }
    
    async function fetchMessages(conversationId) {
        try {
            const response = await fetch(`/staff/conversation/${conversationId}/messages`);
            if (!response.ok) {
                throw new Error(`Error fetching messages: ${response.statusText}`);
            }
    
            const messages = await response.json();
            messageContainer.innerHTML = '';
            
            if (messages.length > 0) {
                currentSenderName = messages[0].sender.name;
                modalHeader.textContent = `${currentSenderName} `;
            }

            messages.forEach(message => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                if (message.sender_id === CURRENT_USER_ID) {
                    messageElement.classList.add('user');
                    messageElement.textContent = `You: ${message.message}`;
                } else {
                    messageElement.classList.add('chatmate');
                    messageElement.textContent = `${message.message}`;
                }
                messageContainer.appendChild(messageElement);
            });
    
            messageContainer.scrollTop = messageContainer.scrollHeight;
        } catch (error) {
            console.error('Error fetching messages:', error);
        }
    }
    
    const viewMessageButtons = document.querySelectorAll('.view-message');
    viewMessageButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const conversationId = button.getAttribute('data-id');
            console.log("Opening chat for conversation ID:", conversationId);
            
            currentConversationId = conversationId;
            toggleChatModal();
            fetchMessages(conversationId);
        });
    });
    
    closeChatModal.addEventListener('click', function () {
        toggleChatModal();
    });
    
    function sendMessage() {
        const messageText = messageInput.value.trim();
        if (messageText === '' || !currentConversationId) return;
    
        const userMessage = document.createElement('div');
        userMessage.classList.add('message', 'user');
        userMessage.textContent = `You: ${messageText}`;
        messageContainer.appendChild(userMessage);
        messageContainer.scrollTop = messageContainer.scrollHeight;
    
        messageInput.value = '';
    
        fetch(`/staff/conversation/${currentConversationId}/send-message`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ message: messageText }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to send message');
            }
            console.log('Message sent successfully');
        })
        .catch(error => {
            console.error('Error sending message:', error);
        });
    }
    
    sendButton.addEventListener('click', sendMessage);
    
    messageInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });
    
    if (!pusher) {
        pusher = new Pusher('df502c6246876de7e65d', {
            cluster: 'ap1',
            encrypted: true,
            disableStats: true,
        });
    
        pusher.connection.bind('state_change', function (states) {
            console.log('Pusher state changed:', states);
            if (states.current === 'disconnected') {
                console.log('Attempting to reconnect to Pusher...');
            }
        });
        pusher.connection.bind('error', function (err) {
            console.error('Pusher connection error:', err);
        });
    }
    if (!channel) {
        channel = pusher.subscribe('chat.' + CURRENT_USER_ID);
        console.log('Subscribed to channel: chat.' + CURRENT_USER_ID);
    }
    
    channel.bind('MessageSent', function(data) {
        console.log('Received message:', data);
        
        if (data.sender_name !== currentSenderName) {
            currentSenderName = data.sender_name;
            modalHeader.textContent = `${currentSenderName} Chat`;
        }
        
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'chatmate');
        messageElement.textContent = `${data.message}`;
        messageContainer.appendChild(messageElement);
    
        messageContainer.scrollTop = messageContainer.scrollHeight;
    });
});
