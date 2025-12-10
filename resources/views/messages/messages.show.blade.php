<x-layouts.main>

    <style>
        /* --- MODERNIZED CHAT UI STYLES (Single Column Focus) --- */

        /* Primary Colors - Using a neutral palette for professionalism */
        :root {
            --primary-green: #38761d;
            --light-bg: #f5f7fa;
            --message-bg-user: #dcf8c6; /* WhatsApp style light green for user */
            --message-bg-other: #ffffff;
            --border-color: #e0e0e0;
            --text-color-primary: #333;
            --header-bg: #f0f0f0;
        }

        /* Container and Full Height Setup */
        .chat-container {
            max-width: 800px;
            margin: 20px auto;
            height: calc(100vh - 40px); /* Fill most of the viewport height */
            display: flex;
            flex-direction: column;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden; /* Contains the border */
        }

        /* Chat Header */
        .classic-header {
            background-color: var(--header-bg) !important;
            color: var(--text-color-primary) !important;
            border-bottom: 1px solid var(--border-color) !important;
            padding: 15px 20px !important;
            flex-shrink: 0;
            font-size: 1.2rem;
            font-weight: 500;
        }

        /* Message History Container */
        .sr-message-history {
            background-color: var(--light-bg);
            padding: 20px; 
            flex-grow: 1; /* Makes the history area take up all available space */
            display: flex; 
            flex-direction: column;
            overflow-y: scroll;
            border: none; /* Remove old border */
        }

        /* Message Structure */
        .sr-message-block { 
            margin-bottom: 15px; /* Increased margin for better spacing */
            display: flex;
        }
        .sr-message-content {
            max-width: 75%; /* Slightly wider messages */
            padding: 10px 15px;
            border-radius: 12px; /* Nicely rounded corners */
            font-size: 15px;
            line-height: 1.4;
            word-wrap: break-word;
            box-shadow: 0 1px 1px rgba(0,0,0,0.08); /* Subtle shadow */
            border: none !important; 
        }
        .sr-message-sender-name {
            font-weight: bold;
            margin-bottom: 4px;
            font-size: 11px;
            display: block;
        }

        /* Sent Messages (User: You) */
        .sr-message-user { 
            justify-content: flex-end; 
        }
        .sr-message-user .sr-message-content {
            background-color: var(--message-bg-user);
            color: var(--text-color-primary);
        }
        .sr-message-user .sr-message-sender-name {
            display: none; /* Keep "You" name hidden for modern look */
        }

        /* Received Messages (User: Other) */
        .sr-message-other { 
            justify-content: flex-start; 
        }
        .sr-message-other .sr-message-content {
            background-color: var(--message-bg-other);
            border: 1px solid #e9e9e9;
        }
        .sr-message-other .sr-message-sender-name {
            color: #777;
            text-align: left;
        }

        /* Input/Send Area */
        .sr-input-container {
            border-top: 1px solid var(--border-color);
            background-color: #fff;
            padding: 15px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
        }
        .sr-input-container form {
            display: flex;
            flex-grow: 1;
        }
        .sr-input-field {
            border: 1px solid var(--border-color) !important;
            padding: 10px 15px !important;
            font-size: 1rem !important;
            border-radius: 20px !important; /* Rounded pill shape */
            flex-grow: 1;
            margin-right: 10px;
        }
        .sr-input-field:focus {
            border-color: var(--primary-green) !important;
            outline: none;
            box-shadow: 0 0 0 2px rgba(56, 118, 29, 0.2);
        }
        .sr-btn-send {
            background-color: var(--primary-green) !important;
            color: white !important;
            padding: 10px 20px !important;
            font-size: 1rem !important;
            border: none !important;
            border-radius: 20px !important;
            transition: background-color 0.2s;
            cursor: pointer;
            font-weight: bold;
        }
        .sr-btn-send:hover {
            background-color: #2e6219 !important;
        }
    </style>
    
    <div class="chat-container">

        {{-- Conversation Header --}}
        <div class="card-header fw-bold classic-header">
            <h1 class="text-start h5 m-0" style="font-weight: normal;">
                🗣️ Conversation with **{{ $conversation->receiver->name ?? 'Unknown User' }}**
            </h1>
        </div>

        {{-- Message History --}}
        <div class="sr-message-history">
            @foreach ($conversation->messages as $message)
                @php
                    use Illuminate\Support\Facades\Auth;
                    $isCurrentUser = ($message->sender_id === Auth::id());
                @endphp

                <div class="sr-message-block {{ $isCurrentUser ? 'sr-message-user' : 'sr-message-other' }}">
                    <div class="sr-message-content">
                        <span class="sr-message-sender-name">
                            @if ($isCurrentUser)
                                You
                            @elseif ($message->sender)
                                {{ $message->sender->name }}
                            @else
                                System
                            @endif
                        </span>

                        {{-- Use {!! !!} if $message->body contains HTML --}}
                        {!! $message->body !!}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Input and Send Button --}}
        <div class="sr-input-container">
            <form method="POST" action="{{ route('message.send', $conversation->id) }}" class="d-flex flex-row">
                @csrf
                <input type="text" name="body" placeholder="Type your message here..." class="sr-input-field" required>
                <button type="submit" class="sr-btn-send">Send</button>
            </form>
        </div>
    </div>

<script>
    // --- LIVE CHAT & SCROLLING LOGIC ---
    // Ensure this script runs only when the conversation is present
    if (typeof window.Echo !== 'undefined' && {{ $conversation->id ?? 'null' }} !== null) {
        
        const currentUserId = {{ auth()->id() }};
        
        const scrollToBottom = () => {
            const history = document.querySelector('.sr-message-history');
            if (history) {
                history.scrollTop = history.scrollHeight;
            }
        };

        const addMessageToUI = (message) => {
            const container = document.querySelector('.sr-message-history');
            if (!container) return;

            const isCurrentUser = message.sender_id == currentUserId;
            // Use message.sender_name from the event payload if available, otherwise default
            const senderName = isCurrentUser ? 'You' : (message.sender_name || 'System');

            container.insertAdjacentHTML('beforeend', `
                <div class="sr-message-block ${isCurrentUser ? 'sr-message-user' : 'sr-message-other'}">
                    <div class="sr-message-content">
                        <span class="sr-message-sender-name">${senderName}</span>
                        ${message.body}
                    </div>
                </div>
            `);
            scrollToBottom();
        };

        // 1. Setup Pusher/Echo Listener
        window.Echo.channel("conversation.{{ $conversation->id }}")
            .listen('.message.sent', (event) => {
                addMessageToUI(event.message);
            });

        // 2. Attach AJAX for Form Submission
        document.addEventListener('DOMContentLoaded', () => {
            scrollToBottom();

            const form = document.querySelector('.sr-input-container form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const inputField = form.querySelector('input[name="body"]');
                    const messageBody = inputField.value;

                    if (messageBody.trim() === '') return;

                    // Optimistically add the message to the UI
                    addMessageToUI({
                        sender_id: currentUserId,
                        sender_name: 'You',
                        body: messageBody
                    });
                    inputField.value = '';

                    // Send the message via AJAX
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams(new FormData(form)).toString()
                    });
                });
            }
        });
    }
</script>
</x-layouts.main>