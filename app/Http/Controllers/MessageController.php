<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConversationController;
use App\Models\Conversation;
use App\Models\Message;

class MessageController extends Controller
{
    public function messageShow($id)
    {
        $conversation = Conversation::with('messages.sender')->findOrFail($id);

        $conversation->messages()
                     ->where('receiver_id', auth()->id()) 
                     ->where('is_read', false)         
                     ->update(['is_read' => true]);     

        return view('messages.show', compact('conversation'));
    }
    
    public function messageSend(Request $request, $conversation_id)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $conversation = Conversation::findOrFail($conversation_id);

        $message = Message::create([
            'conversation_id' => $conversation_id,
            'sender_id' => auth()->id(),
            'receiver_id' => $conversation->sender_id == auth()->id() ? $conversation->receiver_id : $conversation->sender_id,
            'body' => $request->body,
            'type' => 'text',
            'is_read' => false, 
        ]);

        $conversation->update(['last_time_message' => now()]);

        return back()->with('success', 'Message has been sent!');
    }
}