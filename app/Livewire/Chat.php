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

    protected $listeners = [
        'echo:conversation.{conversationId}, MessageSent' => 'handleNewMessage',
    ];
    protected $rules = [
        'body' => 'required|string'
    ];

    public function mount($conversationId)
    {
        $this->conversationId = $conversationId;
    }

    public function handleNewMessage()
    {

    }

    public function sendMessage()
    {
        $this->validate();

        $conversation = Conversation::findOrFail($this->conversationId);

        $receiverId = $conversation->sender_id == Auth::id()
            ? $conversation->receiver_id
            : $conversation->sender_id;

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'type' => 'text',
            'read' => false,
            'body' => Crypt::encryptString($this->body),
        ]);


        broadcast(new MessageSent($message))->toOthers();

        $conversation->update(['last_time_message' => now()]);

        $this->dispatch('chat-message-sent');

        $this->body = '';

    }

    public function getMessagesProperty()
    {
    \Log::info('Fetching messages for Conversation ID: ' . $this->conversationId);
        if (empty($this->conversationId))
            return collect();


        $messages = Message::where('conversation_id', $this->conversationId)
            ->with('sender')
            ->orderBy('created_at')
            ->get();

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

    public function render()
    {
        return view('livewire.chat',[
            'messages' => $this->messages,
        ]);
    }
}
