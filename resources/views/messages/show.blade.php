<x-layouts.main>

<h2>Conversation</h2>

<div>
    @foreach ($conversation->messages as $message)
        <p><strong>{{ $message->sender->name }}:</strong> {{ $message->body }}</p>
    @endforeach
</div>

<form method="POST" action="{{ route('message.send', $conversation->id) }}">
    @csrf
    <input type="text" name="body" placeholder="Aa" class="form-control">
    <button class="btn btn-primary mt-2">Send</button>
</form>

</x-layouts.main>