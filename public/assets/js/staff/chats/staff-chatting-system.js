document.addEventListener('DOMContentLoaded', function () {
    const chatUsersList = document.getElementById('chatUsersList');
    const messageContainer = document.getElementById('messageContainer');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const receiverName = document.getElementById('receiver_name');
    // const CURRENT_USER_ID = {{ json_encode(auth()->id()) }};
    
    let currentConversationId = null;
    let pusher = null;
    let channel = null;

    chatUsersList.addEventListener('click', function (event) {
        const selectedChat = event.target.closest('.chat-user');
        if (!selectedChat) return;

        document.querySelectorAll('.chat-user').forEach(user => user.classList.remove('active'));
        selectedChat.classList.add('active');

        currentConversationId = selectedChat.getAttribute('data-id');
        const clientName = selectedChat.getAttribute('data-client-name');
        receiverName.textContent = clientName;

        fetchMessages(currentConversationId);

        subscribeToConversationChannel(currentConversationId);
    });

    async function fetchMessages(conversationId) {
        try {
            const response = await fetch(`/staff/conversation/${conversationId}/messages`);
            if (!response.ok) {
                throw new Error(`Error fetching messages: ${response.statusText}`);
            }
    
            const messages = await response.json();
            messageContainer.innerHTML = '';
    
            if (messages.length > 0) {
                const receiverName = messages[0].sender_name || "Unknown";
                document.getElementById('receiver_name').textContent = receiverName;
            } else {
                document.getElementById('receiver_name').textContent = "No Messages";
            }
    
            messages.forEach((message) => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
    
                if (message.sender_id === CURRENT_USER_ID) {
                    messageElement.classList.add('user');
                    messageElement.textContent = `${message.message}`;
                } else {
                    messageElement.classList.add('chatmate');
                    messageElement.textContent = `${message.message}`;
                }
    
                messageContainer.appendChild(messageElement);
    
                const timestamp = document.createElement('small');
                timestamp.classList.add('message-timestamp');
                const date = new Date(message.created_at);
                timestamp.textContent = `${date.toLocaleDateString()} : ${date.toLocaleTimeString()}`;
                messageElement.appendChild(timestamp);
    
            });
    
            messageContainer.scrollTop = messageContainer.scrollHeight;
    
        } catch (error) {
            console.error('Error fetching messages:', error);
        }
    }

    function renderMessages(messages) {
        messageContainer.innerHTML = '';
    
        if (messages.length === 0) {
            messageContainer.innerHTML = '<p class="text-muted">No messages yet.</p>';
            return;
        }
    
        messages.forEach((message) => {
            const messageElement = document.createElement('div');
    
            if (message.sender_id === CURRENT_USER_ID) {
                messageElement.classList.add('message', 'user');
                messageElement.textContent = ` ${message.message}`;
            } else {
                messageElement.classList.add('message', 'chatmate');
                messageElement.textContent = `${message.sender_name}: ${message.message}`;
            }
    
            messageContainer.appendChild(messageElement);
        });
    
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }
    

    function sendMessage() {
        const messageText = messageInput.value.trim();
        if (messageText === '' || !currentConversationId) return;
    
        const userMessage = document.createElement('div');
        userMessage.classList.add('message', 'user');
        userMessage.textContent = `${messageText}`;
    
        const timestamp = document.createElement('small');
        timestamp.classList.add('message-timestamp');
        const now = new Date();
        timestamp.textContent = `${now.toLocaleDateString()} : ${now.toLocaleTimeString()}`;
        userMessage.appendChild(timestamp);
    
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
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Error sending message: ${response.statusText}`);
                }
                return response.json();
            })
            .then((data) => {
                console.log('Message sent:', data);
            })
            .catch((error) => {
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
    }

    if (!channel) {
        channel = pusher.subscribe('chat.' + CURRENT_USER_ID);
    }

    function subscribeToConversationChannel(conversationId) {
        if (channel) {
            console.log(`Unsubscribing from channel: ${channel.name}`);
            pusher.unsubscribe(channel.name);
        }
    
        channel = pusher.subscribe(`chat.${conversationId}`);
        console.log(`Subscribed to channel: chat.${conversationId}`);
    
        channel.bind('MessageSent', function (data) {
            console.log('Received MessageSent event:', data);
            appendMessageToChat(data);
    
            if (data.conversation_id === conversationId) {
                console.log('Message belongs to the current conversation:', conversationId);
                
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
    
                if (data.sender_id === CURRENT_USER_ID) {
                    messageElement.classList.add('user');
                    messageElement.textContent = `${data.message}`;
                } else {
                    messageElement.classList.add('chatmate');
                    messageElement.textContent = `${data.sender_name}: ${data.message}`;
                }
    
                messageContainer.appendChild(messageElement);
                messageContainer.scrollTop = messageContainer.scrollHeight;
            } else {
                console.log('Message does not belong to the current conversation:', conversationId);
            }
        });
    
        channel.bind('pusher:subscription_succeeded', function () {
            console.log(`Successfully subscribed to channel: chat.${conversationId}`);
        });
    
        channel.bind('pusher:subscription_error', function (status) {
            console.error(`Failed to subscribe to channel: chat.${conversationId}, status:`, status);
        });
    }
    function appendMessageToChat(data) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message');
    
        if (data.sender_id === CURRENT_USER_ID) {
            messageElement.classList.add('user');
            messageElement.textContent = `${data.message}`;
        } else {
            messageElement.classList.add('chatmate');
            messageElement.textContent = `${data.message}`;
        }
    
        const timestamp = document.createElement('small');
        timestamp.classList.add('message-timestamp');
        const date = new Date(data.created_at);
        timestamp.textContent = `${date.toLocaleDateString()} : ${date.toLocaleTimeString()}`;
        messageElement.appendChild(timestamp);
    
        messageContainer.appendChild(messageElement);
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }
    
    
});
