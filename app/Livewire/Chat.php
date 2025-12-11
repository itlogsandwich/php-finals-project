<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Events\MessageSent;

class Chat extends Component
{
    public $conversationId;
    public $body;
    public $perPage = 20;
    public $totalMessages = 0;
    public $hasMoreMessages = true;

    protected $rules = [
        'body' => 'required|string'
    ];

    public function mount($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->totalMessages = Message::where('conversation_id', $conversationId)->count();
        $this->hasMoreMessages = $this->totalMessages > $this->perPage;
    }

    public function handleNewMessage()
    {
        $this->dispatch('chat-message-sent');
    }

    public function sendMessage()
    {
        $this->validate();

        $conversation = Conversation::findOrFail($this->conversationId);

        $receiverId = $conversation->sender_id == Auth::id()
            ? $conversation->receiver_id
            : $conversation->sender_id;

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'type' => 'text',
            'is_read' => false,
            'body' => Crypt::encryptString($this->body),
        ]);

        $conversation->update(['last_time_message' => now()]);

        $this->dispatch('chat-message-sent');

        $this->body = '';

    }

    public function getMessagesProperty()
    {
        if (empty($this->conversationId))
            return collect();


        $messages = Message::where('conversation_id', $this->conversationId)
            ->with('sender', 'receiver')
            ->orderBy('created_at', 'desc')
            ->limit($this->perPage)
            ->get();

        $messages = $messages->reverse();
        $messagesWithDecryption = $messages->map(function ($msg)
        {
            try
            {
                $msg->decrypted_body = $msg->body ? Crypt::decryptString($msg->body) : '';
            }
            catch (\Illuminate\Contracts\Encryption\DecryptException $e)
            {
                $msg->decrypted_body = '*** Message Error ***';
            }
            return $msg;
        });

        return $messagesWithDecryption;
    }

    public function loadMoreMessages()
    {
        if($this->hasMoreMessages)
        {
            $this->perPage += 20;

            if($this->perPage >= $this->totalMessages)
                $this->hasMoreMessages = false;
        }
    }

    public function render()
    {
        return view('livewire.chat',[
            'messages' => $this->messages,
        ]);
    }
}
