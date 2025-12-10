<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConversationController;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function messageShow($id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->messages()
                     ->where('receiver_id', auth()->id())
                     ->where('is_read', false)
                     ->update(['is_read' => true]);


        return view('messages.show', compact('conversation'));
    }
}
