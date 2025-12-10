<div wire:poll.1000ms>
    {{-- 1. ADD wire:scroll.end and a wire:key to help Livewire manage the scroll position --}}
<div class="sr-message-history" id="sr-message-history" wire:key="message-history" wire:scroll.end="loadMoreMessages">
    @foreach ($messages ?? collect() as $message)
        @php $isCurrentUser = ($message->sender_id === auth()->id()); @endphp

        <div class="sr-message-block {{ $isCurrentUser ? 'sr-message-user' : 'sr-message-other' }}">
            <div class="sr-message-content">
                <span class="sr-message-sender-name">
                    {{ $isCurrentUser ? 'You' : ($message->sender->name ?? 'User') }}
                </span>

                {{-- CRITICAL: Ensure you are using the correct decrypted property --}}
                {{ $message->decrypted_body }}

            </div>
        </div>
    @endforeach
</div>

    <div class="sr-input-container mt-2">
        <form wire:submit.prevent="sendMessage" class="d-flex flex-row">
            {{-- 2. Use wire:model to bind the body --}}
            <input type="text" wire:model="body" class="sr-input-field" placeholder="Aa…" required>
            <button class="sr-btn-send" type="submit">Send</button>
        </form>
    </div>

    {{-- 3. Livewire's JS is now removed and replaced by component/hook calls --}}
    <script>
        // Use a simple, one-time listener for the custom scroll event.
        // The event is fired from the component after a message is successfully sent.
        window.addEventListener('chat-message-sent', function () {
            const container = document.getElementById('sr-message-history');
            container.scrollTop = container.scrollHeight;
        });

        // Initial scroll down on page load
        document.addEventListener('livewire:initialized', function () {
            const container = document.getElementById('sr-message-history');
            container.scrollTop = container.scrollHeight;
        });
    </script>
</div>
