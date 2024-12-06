document.addEventListener('DOMContentLoaded', function () {
    const chatModal = document.getElementById('chatbotModal');
    const messagesContainer = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    // const CURRENT_USER_ID = {{ json_encode(auth()->id()) }};
    let currentConversationId = null;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let pusher = new Pusher('df502c6246876de7e65d', {
        cluster: 'ap1',
        encrypted: true,
        debug: true,
    });

    let channel = null;

    function debugLog(message, data = null) {
        console.log(`[DEBUG] ${message}`, data);
    }

    function subscribeToConversationChannel(conversationId) {
        if (channel) {
            pusher.unsubscribe(channel.name);
        }

        channel = pusher.subscribe(`chat.${conversationId}`);
        debugLog(`Subscribed to channel: chat.${conversationId}`);

        channel.bind('pusher:subscription_succeeded', function () {
            debugLog(`Subscription succeeded for chat.${conversationId}`);
        });

        channel.bind('pusher:subscription_error', function (error) {
            console.error(`Subscription error for chat.${conversationId}:`, error);
        });
        channel.bind('MessageSent', function (data) {
            debugLog('Real-time message received:', data);
        
            if (!data.conversation_id) {
                console.error('[ERROR] conversation_id missing in the real-time message:', data);
                return;
            }
        
            if (parseInt(data.conversation_id) === parseInt(currentConversationId)) {
                appendMessage(data);
            } else {
                console.warn(`[DEBUG] Message does not belong to the current conversation: ${currentConversationId}`);
            }
        });
        
    }

    async function fetchConversation() {
        try {
            const response = await fetch(`/client/conversation/${CURRENT_USER_ID}`);
            if (!response.ok) {
                throw new Error(`Error fetching conversation: ${response.statusText}`);
            }

            const data = await response.json();
            currentConversationId = data.conversation_id;
            subscribeToConversationChannel(currentConversationId);
            fetchMessages(currentConversationId);
        } catch (error) {
            console.error('Error fetching conversation:', error);
        }
    }

    async function fetchMessages(conversationId) {
        try {
            const response = await fetch(`/client/conversation/${conversationId}/messages`);
            if (!response.ok) {
                throw new Error(`Error fetching messages: ${response.statusText}`);
            }

            const messages = await response.json();
            messagesContainer.innerHTML = '';
            messages.forEach(message => appendMessage(message));
        } catch (error) {
            console.error('Error fetching messages:', error);
        }
    }

    function appendMessage(message) {
        if (!messagesContainer) {
            console.error('[ERROR] #chatMessages element not found in the DOM.');
            return;
        }

        const messageElement = document.createElement('li');
        messageElement.classList.add('media');

        if (!messagesContainer) {
            console.error('[ERROR] Message container not found!');
            return;
        }
        console.log('Appending message to #chatMessages');

        if (parseInt(message.sender_id) === parseInt(CURRENT_USER_ID)) {
            messageElement.classList.add('sent');
            messageElement.innerHTML = `
                <div class="msg-box">
                    <p>${message.message}</p>
                    <span class="timestamp">${new Date(message.created_at).toLocaleString()}</span>
                </div>
            `;
        } else {
            messageElement.classList.add('received');
            messageElement.innerHTML = `
                <div class="msg-box">
                    <p>${message.message}</p>
                    <span class="timestamp">${new Date(message.created_at).toLocaleString()}</span>
                </div>
            `;
        }

        messagesContainer.appendChild(messageElement);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    sendButton.addEventListener('click', function () {
        const messageText = messageInput.value.trim();
        if (messageText) {
            sendMessage(currentConversationId, messageText);
        }
    });

    messageInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            const messageText = messageInput.value.trim();
            if (messageText) {
                sendMessage(currentConversationId, messageText);
            }
        }
    });

    async function sendMessage(conversationId, messageText) {
        try {
            const response = await fetch(`/client/conversation/${conversationId}/send-message`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ message: messageText }),
            });

            if (!response.ok) {
                throw new Error(`Error sending message: ${response.statusText}`);
            }

            const message = await response.json();
            appendMessage(message);
            messageInput.value = '';
        } catch (error) {
            console.error('Error sending message:', error);
        }
    }

    fetchConversation();
});
