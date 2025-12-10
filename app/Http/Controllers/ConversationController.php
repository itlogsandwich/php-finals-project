<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
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
        $authId = auth()->id();
        $receiverId = $receiver_id;

        $conversation = Conversation::where(function ($query) use ($authId, $receiverId)
        {
            $query->where('sender_id', $authId)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($authId, $receiverId)
        {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $authId);
        })->first();

        if(!$conversation)
        {
            $conversation = Conversation::create([
                'sender_id' => $authId,
                'receiver_id' => $receiverId,
                'last_time_message' => now(),
            ]);
        }
        return redirect()->route('message.show',$conversation->id);
    }
}
