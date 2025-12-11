<div wire:poll.3000ms>
<div class="sr-message-history" id="sr-message-history" wire:key="message-history" wire:scroll.end="loadMoreMessages">
    @foreach ($messages ?? collect() as $message)
        @php $isCurrentUser = ($message->sender_id === auth()->id()); @endphp

        <div class="sr-message-block {{ $isCurrentUser ? 'sr-message-user' : 'sr-message-other' }}">
            <div class="sr-message-content">
                <span class="sr-message-sender-name">
                    {{ $isCurrentUser ? 'You' : ($message->sender->name ?? 'User') }}
                </span>

                {{ $message->decrypted_body }}

            </div>
        </div>
    @endforeach
</div>

    <div class="sr-input-container mt-2">
        <form wire:submit.prevent="sendMessage" class="d-flex flex-row">
            <input type="text" wire:model="body" class="sr-input-field" placeholder="Aa…" required>
            <button class="sr-btn-send" type="submit">Send</button>
        </form>
    </div>

    <script>
        window.addEventListener('chat-message-sent', function () {
            const container = document.getElementById('sr-message-history');
            container.scrollTop = container.scrollHeight;
        });
        document.addEventListener('livewire:initialized', function () {
            const container = document.getElementById('sr-message-history');
            container.scrollTop = container.scrollHeight;
        });
    </script>
</div>
