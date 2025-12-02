<x-layouts.main>
    
    <style>
        /* --- General Market Aesthetic Styles --- */
        .classic-header { 
            background-color: #3b5734 !important; /* Dark Green */
            color: #ffffff !important; 
            border-bottom: 3px solid #3b5734;
        }
        .classic-border { border: 1px solid #ccc !important; }
        .list-group-item {
            border-color: #ddd !important;
            transition: background-color 0.1s;
        }
        /* Highlight the active item based on the ID passed from the controller */
        .list-group-item:hover, .conversation-link.active .list-group-item { 
            background-color: #e0f0e0 !important; /* Light Green hover/active */
        }
        .classic-text { color: #333; }
        .classic-small-text { font-size: 0.8rem; color: #666; }

        /* --- Conversation History Styles --- */
        body { font-family: Tahoma, Arial, sans-serif; }
        
        .sr-message-history {
            /* 100% minus header and input */
            flex-grow: 1; 
            overflow-y: scroll;
            border-bottom: 1px solid #ddd;
            background-color: #fcfcfc;
            padding: 15px;
            margin-bottom: 0;
            display: flex; /* Added for initial empty state centering */
            flex-direction: column; /* Added for initial empty state centering */
        }

        /* Message Bubble Styles (Retained for market aesthetic) */
        .sr-message-block { margin-bottom: 10px; display: flex; }
        .sr-message-content { max-width: 70%; padding: 8px 12px; border-radius: 0; font-size: 14px; line-height: 1.4; border: 1px solid transparent; word-wrap: break-word; }
        .sr-message-user { justify-content: flex-end; }
        .sr-message-user .sr-message-content { background-color: #e0f0e0; border-color: #c0d0c0; text-align: right; }
        .sr-message-user .sr-message-sender-name { color: #486b40; font-weight: bold; margin-bottom: 3px; font-size: 11px; display: block; }
        .sr-message-other { justify-content: flex-start; }
        .sr-message-other .sr-message-content { background-color: #fff; border-color: #ddd; text-align: left; }
        .sr-message-other .sr-message-sender-name { color: #777; font-weight: bold; margin-bottom: 3px; font-size: 11px; display: block; }

        /* Input Styles */
        .sr-input-container { border-top: 1px solid #ddd; background-color: #f7f7f7; padding: 10px; flex-shrink: 0; }
        .sr-input-field { border: 1px solid #aaa; padding: 5px 8px; font-family: Arial, sans-serif; font-size: 13px; border-radius: 0; background-color: #fff; flex-grow: 1; }
        .sr-btn-send { background-color: #486b40; color: white; padding: 5px 12px; font-size: 13px; border: 1px solid #3b5734; border-radius: 0; cursor: pointer; font-weight: bold; white-space: nowrap; margin-left: 5px; }
    </style>

    <div class="d-flex flex-row" style="height: 90vh; max-width: 1200px; margin: 20px auto;">
        
        {{-- 1. LEFT PANEL: Conversation List --}}
        <div class="card rounded-0 classic-border" style="width: 320px; flex-shrink: 0; background-color: #fff; height: 100%;">
            <div class="card-header fw-bold rounded-0 classic-header" style="padding: 12px 15px;">
                <h1 class="text-start h5 m-0" style="font-weight: normal;">
                    Messages & Conversations
                </h1>
            </div>
            
            <ul class="list-group list-group-flush rounded-0" id="conversationList" style="overflow-y: auto; flex-grow: 1;">
                @if(isset($conversations))
                    @foreach($conversations as $conversation_item)
                        @php
                            // Determine the other user (sender or receiver) based on the current auth user
                            $otherUser = $conversation_item->sender_id === auth()->id() 
                                ? $conversation_item->receiver 
                                : $conversation_item->sender;
                            
                            // *** IMPROVED NULL-SAFE ACCESS ***
                            $otherUserName = $otherUser?->name ?? 'Unknown User';
                            
                            $isActive = (isset($conversation) && $conversation->id === $conversation_item->id) ? 'active' : '';
                        @endphp

                        <a href="#" 
                            onclick="loadConversation(event, '{{ route('message.show', $conversation_item->id) }}', '{{ $otherUserName }}', '{{ route('message.send', $conversation_item->id) }}', '{{ $conversation_item->id }}')"
                            data-conversation-id="{{ $conversation_item->id }}"
                            data-other-user-name="{{ $otherUserName }}"
                            class="text-decoration-none classic-text conversation-link {{ $isActive }}">
                            
                            <li class="d-flex flex-row list-group-item justify-content-between align-items-center rounded-0 p-3 mb-0"
                                style="cursor: pointer; background-color: {{ $isActive ? '#e0f0e0' : '#fff' }};">
                                
                                <div class="flex-grow-1">
                                    <h4 class="m-0 classic-text" style="font-size: 1rem; font-weight: bold;">
                                        {{ $otherUserName }}
                                    </h4>
                                    
                                    <p class="classic-small-text m-0 pt-1">
                                        {{-- FIX: Robustly check for null and cast to Carbon if needed --}}
                                        @if ($conversation_item->last_time_message)
                                            @php
                                                $lastActivity = is_string($conversation_item->last_time_message) 
                                                    ? \Carbon\Carbon::parse($conversation_item->last_time_message) 
                                                    : $conversation_item->last_time_message;
                                            @endphp
                                            Last Activity: {{ $lastActivity->diffForHumans() }}
                                        @else
                                            Last Activity: N/A
                                        @endif
                                    </p> 
                                </div>
                            </li>
                        </a>
                    @endforeach
                @else
                    <li class="p-3 classic-small-text">No conversations found.</li>
                @endif
            </ul>
        </div>

        {{-- 2. RIGHT PANEL: Active Chat History and Input --}}
        <div class="d-flex flex-column flex-fill classic-border rounded-0" style="margin-left: 20px; background-color: #fff;">
            
            <div id="chatHistoryContent" class="d-flex flex-column flex-grow-1">
                @if(isset($conversation))
                    {{-- Load chat partial if a conversation is already selected (e.g., from a redirect or initial load) --}}
                    @include('messages.partials.chat-history', ['conversation' => $conversation])
                @else
                    {{-- Default Placeholder --}}
                    <div class="container classic-bg d-flex justify-content-center align-items-center flex-column flex-grow-1" style="background-color: #f8f8f8; height: 100%;">
                        <h3 class="text-muted text-center" style="font-size: 1.5rem; font-weight: 300;">
                            Please select a conversation from the list to view the chat history.
                        </h3>
                    </div>
                @endif
            </div>

            {{-- Message Input Form --}}
            <div id="messageInputContainer" class="sr-input-container" style="display: {{ isset($conversation) ? 'block' : 'none' }};">
                {{-- Action is set via PHP route helper if conversation exists, or by JS if selected via click --}}
                <form id="messageForm" method="POST" action="{{ isset($conversation) ? route('message.send', $conversation->id) : '' }}">
                    @csrf
                    <div class="d-flex flex-row">
                        <input type="text" name="body" placeholder="Type your message here..." class="sr-input-field" required>
                        <button type="submit" class="sr-btn-send">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // --- Polling and State Variables ---
        let currentPollTimer = null;
        let currentConversationId = null;
        const pollInterval = 1000; // Check for new messages every 1 second (Set to user request)

        /**
         * Scrolls the message history container to the bottom.
         */
        function scrollToBottom() {
            const historyDiv = document.querySelector('.sr-message-history');
            if (historyDiv) {
                // Use a slight delay to ensure the content has rendered fully before scrolling
                setTimeout(() => {
                    historyDiv.scrollTop = historyDiv.scrollHeight;
                }, 50);
            }
        }

        /**
         * Stops the current polling timer.
         */
        function stopPolling() {
            if (currentPollTimer) {
                clearInterval(currentPollTimer);
                currentPollTimer = null;
                currentConversationId = null;
            }
        }

        /**
         * Starts the polling mechanism for the active conversation.
         */
        function startPolling(secureRouteUrl, receiverName) {
            stopPolling(); // Stop any existing timer

            currentPollTimer = setInterval(() => {
                pollMessages(secureRouteUrl, receiverName);
            }, pollInterval);
        }
        
        /**
         * The core polling logic: fetches full history and checks for new messages.
         */
        function pollMessages(secureRouteUrl, receiverName) {
            const chatHistoryContent = document.getElementById('chatHistoryContent');
            
            fetch(secureRouteUrl, {
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Polling failed. Status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                // 1. Find the current message count on the screen
                const currentMessages = document.querySelectorAll('#chatHistoryContent .sr-message-block');
                const currentCount = currentMessages.length;

                // 2. Create a temporary element to count messages in the new HTML
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                const newCount = tempDiv.querySelectorAll('.sr-message-block').length;

                // 3. If new messages are detected, update the chat history and scroll
                if (newCount > currentCount) {
                    console.log(`New messages detected: ${newCount - currentCount}`);
                    chatHistoryContent.innerHTML = html;
                    scrollToBottom();
                } 
                // If the count is the same, no action is needed.
            })
            .catch(error => {
                console.error('Error during polling:', error);
                // We let the connection fail silently if it's just a network wobble
            });
        }


        /**
         * Loads conversation history into the right panel using AJAX.
         * Includes a security fix to force HTTPS protocol for the request URL.
         */
        function loadConversation(e, routeUrl, receiverName, sendRouteUrl, conversationId) {
            e.preventDefault();

            const linkElement = e.currentTarget;
            // Removed redundancy: conversationId is now passed directly
            const chatHistoryContent = document.getElementById('chatHistoryContent');
            const messageInputContainer = document.getElementById('messageInputContainer');
            const messageForm = document.getElementById('messageForm');
            const secureRouteUrl = routeUrl.replace(/^http:\/\//i, 'https://');


            // 1. Update Active State in List
            document.querySelectorAll('.conversation-link').forEach(link => {
                link.classList.remove('active');
                link.querySelector('li').style.backgroundColor = '#fff';
            });
            linkElement.classList.add('active');
            linkElement.querySelector('li').style.backgroundColor = '#e0f0e0';

            // 2. Display Loading State & Update Form Action immediately
            chatHistoryContent.innerHTML = `
                <div class="classic-header" style="padding: 12px 15px; flex-shrink: 0;">
                    <h2 class="text-start h5 m-0" style="font-weight: bold; color: white;">
                        Conversation with ${receiverName}
                    </h2>
                </div>
                <div class="sr-message-history d-flex justify-content-center align-items-center">
                    <p class="classic-small-text">Loading messages...</p>
                </div>
            `;
            
            // 3. Update Input Form Action and show it
            messageForm.action = sendRouteUrl; 
            messageInputContainer.style.display = 'block';

            // 4. Start Polling for the new conversation
            currentConversationId = conversationId;
            startPolling(secureRouteUrl, receiverName);

            // 5. Initial AJAX Fetch for Chat History (using secureRouteUrl)
            fetch(secureRouteUrl, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    const statusText = response.statusText || 'Unknown Error';
                    throw new Error(`Network response was not ok. Status: ${response.status} (${statusText})`);
                }
                return response.text();
            })
            .then(html => {
                // 6. Inject the loaded HTML (Header + History)
                chatHistoryContent.innerHTML = html;
                scrollToBottom();
            })
            .catch(error => {
                console.error('Error loading conversation:', error);
                // Display a more specific error message to the user
                chatHistoryContent.innerHTML = `
                    <div class="sr-message-history d-flex justify-content-center align-items-center">
                        <p class="classic-small-text" style="color: red;">Error: Could not load conversation history. ${error.message}. Check console for details.</p>
                    </div>
                `;
            });
        }

        /**
         * Handles AJAX message submission, expecting a JSON response from the server.
         */
        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const historyDiv = document.querySelector('.sr-message-history');
            const inputField = form.querySelector('input[name="body"]');
            const csrfToken = form.querySelector('input[name="_token"]').value;
            const messageBody = inputField.value.trim();

            // --- Client-Side Validation ---
            if (!messageBody) {
                inputField.focus();
                return;
            }
            
            if (!form.action || form.action.endsWith('/message/')) {
                const actionError = 'Error: No conversation selected. Please click on a user on the left first to start a chat.';
                if (historyDiv) {
                    historyDiv.insertAdjacentHTML('beforeend', `<p class="p-3 classic-small-text" style="color: red; text-align: center;">${actionError}</p>`);
                }
                console.error(actionError);
                return;
            }
            // --- END Validation ---

            // --- CRITICAL: Explicitly construct FormData and normalize URL ---
            const formData = new FormData();
            formData.append('_token', csrfToken); 
            formData.append('body', messageBody); 
            
            // FIX: Normalize the URL to HTTPS before fetching (Fixes Failed to fetch)
            const secureFormAction = form.action.replace(/^http:\/\//i, 'https://');
            // ------------------------------------------------------------------

            inputField.disabled = true;
            const sendButton = form.querySelector('button[type="submit"]');
            sendButton.disabled = true;

            fetch(secureFormAction, {
                method: 'POST',
                body: formData, // Use the explicitly constructed FormData
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json' 
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                
                // --- IMPROVED ERROR HANDLING ---
                return response.json()
                    .catch(() => {
                        // If response is not JSON, throw generic error
                        throw new Error(`Message submission failed. Status: ${response.status} (${response.statusText || 'Unknown Error'}). The server did not return a valid JSON response.`);
                    })
                    .then(err => {
                        let errorDetail = `Status: ${response.status} (${response.statusText || 'Unknown Error'}).`;
                        
                        if (response.status === 422 && err.errors) {
                            // Handle Laravel Validation Errors (422 Unprocessable Entity)
                            const validationMessages = Object.values(err.errors).flat().join('; ');
                            errorDetail = `Validation failed: ${validationMessages}. ${errorDetail}`;
                        } else if (err.message) {
                            // Handle generic JSON error message from server
                            errorDetail = `Server Error: ${err.message}. ${errorDetail}`;
                        }
                        
                        throw new Error(errorDetail);
                    });
            })
            .then(data => {
                if (data.success) {
                    // This is the SENDER's view: Update locally immediately.
                    const newMessageHtml = `
                        <div class="sr-message-block sr-message-user">
                            <div class="sr-message-content">
                                <span class="sr-message-sender-name">You</span>
                                ${data.new_message.body}
                                <br>
                                <small class="classic-small-text" style="opacity: 0.7;">
                                    Just now
                                </small>
                            </div>
                        </div>
                    `;
                    
                    if (historyDiv) {
                        historyDiv.insertAdjacentHTML('beforeend', newMessageHtml);
                        scrollToBottom();
                    }
                    
                    inputField.value = ''; // Reset only the input field, not the whole form
                } else {
                    console.error('Server reported failure:', data.message);
                    const errorMessage = data.message || 'Message failed to send (Server reported unknown failure).';
                    const errorBox = document.getElementById('chatHistoryContent');
                    errorBox.insertAdjacentHTML('beforeend', `<p class="p-3 classic-small-text" style="color: red; text-align: center;">Error: ${errorMessage}</p>`);
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                // Use the detailed error message captured from the response chain
                const errorBox = document.getElementById('chatHistoryContent');
                errorBox.insertAdjacentHTML('beforeend', `<p class="p-3 classic-small-text" style="color: red; text-align: center;">Error: An error occurred while sending. ${error.message}</p>`);
            })
            .finally(() => {
                inputField.disabled = false;
                sendButton.disabled = false;
                inputField.focus();
            });
        });

        // Initial setup on page load
        document.addEventListener('DOMContentLoaded', () => {
            // Check if a conversation was loaded on initial page render
            const messageForm = document.getElementById('messageForm');
            // This checks if the action URL is a non-empty string that does not end with the base path '/message/'
            const actionIsSet = messageForm && messageForm.action && messageForm.action.split('/').pop().length > 0;
            
            if (actionIsSet) {
                // Initial scroll for the chat history rendered by PHP
                scrollToBottom();

                // If a conversation was pre-loaded by PHP, we need to extract the data to start polling it.
                // Find the active link to get the correct data attributes.
                const activeLink = document.querySelector('.conversation-link.active');
                if (activeLink) {
                    const routeUrl = activeLink.getAttribute('onclick').match(/'(.*?)'/g)[0].slice(1, -1);
                    const receiverName = activeLink.getAttribute('data-other-user-name');
                    
                    // Note: We don't need to reload the chat, just start the polling mechanism
                    currentConversationId = activeLink.getAttribute('data-conversation-id');
                    const secureRouteUrl = routeUrl.replace(/^http:\/\//i, 'https://');
                    startPolling(secureRouteUrl, receiverName);
                }
            }
        });
    </script>
</x-layouts.main>