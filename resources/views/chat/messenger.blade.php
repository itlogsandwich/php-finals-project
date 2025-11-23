<x-layouts.main>
    
    <style>
        /* Base Styling for Chat Bubbles (Copied from messages/show) */
        .sr-message-history {
            height: calc(90vh - 170px); /* Adjusted height to fit the whole screen */
            overflow-y: scroll;
            padding: 15px;
            background-color: #f7f7f7;
        }

        .sr-message-block { margin-bottom: 10px; display: flex; }
        
        .sr-message-content {
            max-width: 70%;
            padding: 10px 14px;
            border-radius: 15px;
            font-size: 15px;
            line-height: 1.4;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            word-wrap: break-word;
        }

        /* User Messages (Right) */
        .sr-message-user { justify-content: flex-end; }
        .sr-message-user .sr-message-content {
            background-color: #dcf8c6;
            color: #1f2124;
            border-bottom-right-radius: 2px;
        }

        /* Other User Messages (Left) */
        .sr-message-other { justify-content: flex-start; }
        .sr-message-other .sr-message-content {
            background-color: #fff;
            color: #1f2124;
            border-bottom-left-radius: 2px;
        }
        
        /* Input Styles */
        .sr-input-container {
            border-top: 1px solid #ddd;
            padding: 10px 0 0 0;
            margin-top: 5px;
        }
        .sr-input-field {
            border: 1px solid #ccc;
            padding: 10px 12px;
            border-radius: 20px;
            flex-grow: 1; 
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        }
        .sr-btn-send {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            margin-left: 10px;
            transition: background-color 0.2s;
        }
        .sr-btn-send:hover {
            background-color: #0056b3;
        }
        
        /* Conversation List Styling */
        .sr-conversation-item:hover {
            background-color: #f0f0f0;
        }
        .sr-active-conversation {
            background-color: #e9e9e9;
            font-weight: bold;
            border-left: 5px solid #007bff;
        }
        .sr-chat-panel {
            flex-grow: 1;
            padding: 0 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

    </style>

    <div class="d-flex flex-row" style="height: 90vh; border: 1px solid #ddd; background-color: #fff;">
        
        {{-- LEFT SIDE: Conversation List --}}
        <div class="card border-0 border-right" style="width: 300px; flex-shrink: 0;">
            <div class="card-header fw-bold bg-primary text-white border-0">
                <h1 class="text-center h5 m-0 p-2">Chats</h1>
            </div>
            <ul class="list-group list-group-flush" style="overflow-y: auto; height: 100%;">
                @forelse($conversations as $conversation)
                    {{-- Active Conversation Check (We assume the current $conversation is active if $activeConversation is set) --}}
                    @php
                        $isActive = isset($activeConversation) && $activeConversation->id === $conversation->id;
                    @endphp
                    
                    {{-- Link to reload the same view, but with the specific conversation ID as a query parameter --}}
                    <a href="{{ route('chat.index', ['id' => $conversation->id]) }}" style="text-decoration: none; color: inherit;">
                        <li class="d-flex flex-row list-group-item justify-content-between rounded-0 p-3 mb-0 sr-conversation-item {{ $isActive ? 'sr-active-conversation' : '' }}"
                            style="cursor: pointer; border-bottom: 1px solid #eee;">
                            
                            <div>
                                <h5 class="h6 m-0">{{ $conversation->otherUser?->name ?? 'Unknown User' }}</h5>
                                <p class="text-muted" style="font-size: 0.8rem; margin-bottom: 0;">
                                    {{-- Defensive Check (Final Fix for diffForHumans) --}}
                                    @if ($conversation->last_time_message && !is_string($conversation->last_time_message))
                                        {{ $conversation->last_time_message->diffForHumans() }}
                                    @else
                                        {{ $conversation->last_time_message ?? 'N/A' }}
                                    @endif
                                </p> 
                            </div>
                        </li>
                    </a>
                @empty
                    <li class="list-group-item text-center text-muted p-4">No conversations found.</li>
                @endforelse
            </ul>
        </div>

        {{-- RIGHT SIDE: Active Chat Panel --}}
        <div class="sr-chat-panel">
            @if(isset($activeConversation))
                <div class="p-3 border-bottom bg-light">
                    <h2 class="h5 m-0">**{{ $activeConversation->otherUser->name ?? 'Unknown User' }}**</h2>
                </div>

                {{-- Message History --}}
                <div class="sr-message-history">
                    @foreach ($activeConversation->messages as $message)
                        @php
                            $isCurrentUser = ($message->sender_id === Auth::id());
                        @endphp

                        <div class="sr-message-block {{ $isCurrentUser ? 'sr-message-user' : 'sr-message-other' }}">
                            <div class="sr-message-content">
                                {{ $message->body }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Message Input/Footer --}}
                <div class="sr-input-container">
                    <form method="POST" action="{{ route('message.send', $activeConversation->id) }}" class="d-flex flex-row">
                        @csrf
                        <input type="text" name="body" placeholder="Type your message..." class="sr-input-field" required>
                        <button type="submit" class="sr-btn-send">Send</button>
                    </form>
                </div>

            @else
                <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                    <h3 class="text-muted">Select a conversation to start chatting.</h3>
                </div>
            @endif
        </div>
    </div>
</x-layouts.main>