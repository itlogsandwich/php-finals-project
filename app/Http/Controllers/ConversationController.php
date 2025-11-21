<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;

class ConversationController extends Controller
{
    public function conversationShow()
    {
        $conversations = Conversation::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver'])
            ->orderBy('last_time_message', 'desc')
            ->get();

        return view('conversations.show', compact('conversations'));
    }

    public function conversationStart($receiver_id)
    {
       $conversation = Conversation::firstOrCreate(
        [
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver_id,
        ],
        [
            'last_time_message' => now(),
        ]
        );

        return redirect()->route('messages.show', compact($conversation->id));
    }
}
