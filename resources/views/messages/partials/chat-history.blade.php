<div class="classic-header" style="padding: 12px 15px; flex-shrink: 0;">
    {{-- 
        PHP logic to determine the name of the other user for the header.
        This relies on the Controller passing the $conversation object. 
    --}}
    @php
        // Identify the user who is NOT the current authenticated user
        $otherUser = $conversation->sender_id === auth()->id() 
            ? $conversation->receiver 
            : $conversation->sender;
        
        // Use null-safe operator (?->) to prevent crashes if the user record is missing
        $otherUserName = $otherUser?->name ?? 'Unknown User';
    @endphp

    <h2 class="text-start h5 m-0" style="font-weight: bold; color: white;">
        Conversation with {{ $otherUserName }}
    </h2>
</div>

<div class="sr-message-history">
    {{-- Loop through the messages relationship of the conversation object --}}
    @if(isset($conversation->messages) && $conversation->messages->isNotEmpty())
        @foreach($conversation->messages as $message)
            @php
                // Determine styling: is this message from the current authenticated user?
                $isCurrentUser = $message->sender_id === auth()->id();
                $className = $isCurrentUser ? 'sr-message-user' : 'sr-message-other';
                
                // Set sender name (use 'You' if current user, otherwise use sender's name with null-safe check)
                $senderName = $isCurrentUser 
                    ? 'You' 
                    : ($message->sender?->name ?? 'Unknown User');
            @endphp

            <div class="sr-message-block {{ $className }}">
                <div class="sr-message-content">
                    {{-- The sender's name is displayed above the bubble --}}
                    <span class="sr-message-sender-name">{{ $senderName }}</span>
                    
                    {{-- The actual message body --}}
                    {{ $message->body }}
                    
                    <br>
                    {{-- Display the message timestamp using Laravel's Carbon diffForHumans() --}}
                    <small class="classic-small-text" style="opacity: 0.7;">
                        {{ $message->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        @endforeach
    @else
        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
            <p class="classic-small-text text-muted">No messages in this conversation yet.</p>
        </div>
    @endif
</div>