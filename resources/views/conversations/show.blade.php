<x-layouts.main>
    
    <style>
        /* Classic Forum/Market Aesthetic Styles */
        .classic-bg { background-color: #f8f8f8 !important; }
        .classic-header { 
            background-color: #3b5734 !important; /* Matches main layout header */
            color: #ffffff !important; 
            border-bottom: 3px solid #3b5734;
        }
        .classic-border { border: 1px solid #ccc !important; }
        .list-group-item {
            border-color: #ddd !important;
            transition: background-color 0.1s;
        }
        .list-group-item:hover { 
            background-color: #ededed !important; 
        }
        .classic-text { color: #333; }
        .classic-small-text { font-size: 0.8rem; color: #666; }
    </style>

    {{-- The container now holds the conversation list (left) and the chat area (right) --}}
    <div class="d-flex flex-row" style="height: 90vh;">
        
        {{-- LEFT SIDE: Conversation List --}}
        <div class="card rounded-0 classic-border" style="width: 28rem; flex-shrink: 0; background-color: #fff;">
            <div class="card-header fw-bold rounded-0 classic-header" style="padding: 12px 15px;">
                <h1 class="text-start h5 m-0" style="font-weight: normal;">
                    Messages & Conversations
                </h1>
            </div>
            
            <ul class="list-group list-group-flush rounded-0" style="overflow-y: auto;">
                @foreach($conversations as $conversation)
                    {{-- Link the list item to the individual message show page --}}
                    <a href="{{ route('message.show', $conversation->id) }}" 
                       class="text-decoration-none classic-text">
                        
                        <li class="d-flex flex-row list-group-item justify-content-between align-items-center rounded-0 p-3 mb-0"
                            style="cursor: pointer; background-color: #fff;">
                            
                            <div class="flex-grow-1">
                                {{-- Display the name of the OTHER user in the conversation list --}}
                                <h4 class="m-0 classic-text" style="font-size: 1rem; font-weight: bold;">
                                    {{ $conversation->otherUser?->name ?? 'Unknown User' }}
                                </h4>
                                
                                {{-- Display the last message time --}}
                                <p class="classic-small-text m-0 pt-1">
                                    @if ($conversation->last_time_message && !is_string($conversation->last_time_message))
                                        Last Activity: {{ $conversation->last_time_message->diffForHumans() }}
                                    @else
                                        Last Activity: N/A
                                    @endif
                                </p> 
                            </div>
                            
                            {{-- Placeholder for Unread Count / Badge --}}
                            {{-- <span class="badge bg-danger rounded-0 classic-small-text" style="padding: 0.4em 0.7em;">3</span> --}}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>

        {{-- RIGHT SIDE: Empty Area for Chat Preview/Placeholder --}}
        <div class="d-flex flex-row flex-fill">
            <div class="container classic-border rounded-0 m-3 p-4 classic-bg d-flex justify-content-center align-items-center flex-column" style="background-color: #f8f8f8;">
                <h3 class="text-muted text-center" style="font-size: 1.5rem; font-weight: 300;">
                    Please select a conversation from the list to view the chat history.
                </h3>
            </div>
        </div>
    </div>
</x-layouts.main>