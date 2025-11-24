<x-layouts.main>
    
    <style>
        /* Base Styling */
        body { font-family: Tahoma, Arial, sans-serif; }
        
        /* Main message history container */
        .sr-message-history {
            height: 500px; /* Fixed height for scrollability */
            overflow-y: scroll;
            border: 1px solid #ddd;
            background-color: #fcfcfc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 0;
        }

        /* Base message container */
        .sr-message-block {
            margin-bottom: 10px;
            display: flex; /* Enables alignment */
        }
        
        /* Message bubble/content box */
        .sr-message-content {
            max-width: 70%;
            padding: 8px 12px;
            border-radius: 0;
            font-size: 14px;
            line-height: 1.4;
            border: 1px solid transparent;
            word-wrap: break-word;
        }

        /* Styles for messages sent BY THE CURRENT USER (Right alignment) */
        .sr-message-user {
            justify-content: flex-end; /* Pushes the message block to the right */
        }
        .sr-message-user .sr-message-content {
            background-color: #e0f0e0; /* Very light green background */
            border-color: #c0d0c0;
            text-align: right;
        }
        .sr-message-user .sr-message-sender-name {
            color: #486b40; /* SR Green for "You" */
            font-weight: bold;
            margin-bottom: 3px;
            font-size: 11px;
            display: block;
        }

        /* Styles for messages sent BY THE OTHER USER (Left alignment) */
        .sr-message-other {
            justify-content: flex-start;
        }
        .sr-message-other .sr-message-content {
            background-color: #fff; /* White background */
            border-color: #ddd;
            text-align: left;
        }
        .sr-message-other .sr-message-sender-name {
            color: #777;
            font-weight: bold;
            margin-bottom: 3px;
            font-size: 11px;
            display: block;
        }
        
        /* --- MESSAGE INPUT/FOOTER STYLES (FROM PREVIOUS SNIPPET) --- */
        .sr-input-container {
            border-top: 1px solid #ddd;
            background-color: #f7f7f7; 
            padding: 10px;
            border-radius: 0;
        }
        .sr-input-field {
            border: 1px solid #aaa;
            padding: 5px 8px;
            font-family: Arial, sans-serif;
            font-size: 13px;
            border-radius: 0;
            background-color: #fff;
            flex-grow: 1; 
        }
        .sr-btn-send {
            background-color: #486b40; /* Forest Green */
            color: white;
            padding: 5px 12px;
            font-size: 13px;
            border: 1px solid #3b5734;
            border-radius: 0;
            cursor: pointer;
            font-weight: bold;
            white-space: nowrap; 
            margin-left: 5px;
        }
    </style>
    <div class="container" style="max-width: 800px; margin-top: 20px;">

        <h2>Conversation with {{ $conversation->receiver->name ?? 'Unknown User' }}</h2>

        <div class="sr-message-history">
            @foreach ($conversation->messages as $message)
                @php
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
                        
                        {{ $message->body }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="sr-input-container">
            <form method="POST" action="{{ route('message.send', $conversation->id) }}" class="d-flex flex-row">
                @csrf
                <input type="text" name="body" placeholder="Aa" class="sr-input-field" required>
                <button type="submit" class="sr-btn-send">Send</button>
            </form>
        </div>
        
    </div>

</x-layouts.main>