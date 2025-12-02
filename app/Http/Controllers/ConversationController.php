<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;

class ConversationController extends Controller
{
    /**
     * Shows the conversation list and optionally loads a specific conversation.
     */
    public function conversationShow(Request $request)
    {
        // Fetch all conversations involving the authenticated user
        $conversations = Conversation::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver'])
            ->orderBy('last_time_message', 'desc')
            ->get();
        
        $selectedConversationId = $request->get('selected_id');
        $conversation = null;

        // If a specific conversation is requested (e.g., after starting a new chat), load it.
        if ($selectedConversationId) {
             $conversation = Conversation::with(['messages.sender', 'receiver', 'sender'])
                                         ->find($selectedConversationId);
        }

        // Assuming your main, merged view is 'conversations.show'
        return view('conversations.show', compact('conversations', 'conversation'));
    }

    /**
     * Starts a new conversation (or finds an existing one) and redirects to the unified view.
     */
    public function conversationStart($receiver_id)
    {
        $currentUserId = auth()->id();
        
        // --- FIX: Search for conversation where users are sender/receiver in EITHER direction ---
        $conversation = Conversation::where(function ($query) use ($receiver_id, $currentUserId) {
            $query->where('sender_id', $currentUserId)
                  ->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id, $currentUserId) {
            $query->where('sender_id', $receiver_id)
                  ->where('receiver_id', $currentUserId);
        })->first();

        // If no conversation exists, create a new one
        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_id' => $currentUserId,
                'receiver_id' => $receiver_id,
                'last_time_message' => now(),
            ]);
        }
        // ------------------------------------------------------------------------------------------

        // Redirect to the main conversation view, passing the new ID as a query parameter
        return redirect()->route('conversation.show', ['selected_id' => $conversation->id]);
    }
}