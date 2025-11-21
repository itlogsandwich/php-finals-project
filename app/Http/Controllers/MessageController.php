<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messageShow($id)
    {
        $conversation = Conversation::with('message.sender')->findOrFail($id);

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
        ]);

        $conversation->update(['last_time_message' => now(),]);

        return back()->with('success', 'Message has been sent!');
    }
}
