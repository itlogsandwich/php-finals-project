<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Displays a conversation's messages. Returns HTML partial for AJAX requests.
     */
    public function messageShow(Request $request, $id)
    {
        $conversation = Conversation::with(['messages.sender', 'receiver', 'sender'])->findOrFail($id);

        // --- FIX FOR 500 ERROR: Simplified "Mark as Read" logic ---
        // Mark all messages as read where the current user is NOT the sender
        // and the 'read' flag is currently false. This avoids relying on a separate
        // 'receiver_id' column on the 'messages' table if your schema doesn't include it.
        $conversation->messages()
                     ->where('sender_id', '!=', auth()->id()) 
                     ->where('read', false)      
                     ->update(['read' => true]);     
        // -----------------------------------------------------------

        // *** FIX: Check if the request is an AJAX call ***
        if ($request->ajax()) {
            // If AJAX, return ONLY the rendered HTML partial for the right panel.
            return view('messages.partials.chat-history', compact('conversation'))->render();
        }

        // If not AJAX, this is a direct hit. We still need to pass the conversation list 
        // to render the full page (left panel).
        $conversations = Conversation::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver'])
            ->orderBy('last_time_message', 'desc')
            ->get();
        
        // Assuming your main, merged view is 'conversations.show'
        return view('conversations.show', compact('conversation', 'conversations'));
    }
    
    /**
     * Sends a new message. Returns JSON for AJAX requests.
     */
    public function messageSend(Request $request, $conversation_id)
    {
        // --- FIX: Use array validation notation and capture validated data ---
        $validatedData = $request->validate([
            // Enforce required, string type, and a character limit for security and database safety.
            'body' => ['required', 'string', 'max:5000'],
        ]);
        // --------------------------------------------------------------------

        $conversation = Conversation::findOrFail($conversation_id);

        // Determine the receiver ID
        $receiverId = $conversation->sender_id == auth()->id() ? $conversation->receiver_id : $conversation->sender_id;

        $message = Message::create([
            'conversation_id' => $conversation_id,
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'body' => $validatedData['body'], // Use validated data instead of $request->body
            'type' => 'text',
            'read' => false, 
        ]);

        $conversation->update(['last_time_message' => now()]);

        // *** FIX: Check if the request is an AJAX call ***
        if ($request->ajax()) {
            // Return a JSON response for the client-side JavaScript to handle
            return response()->json([
                'success' => true, 
                'message' => 'Message sent successfully.',
                'new_message' => $message,
                'sender_name' => Auth::user()->name ?? 'You'
            ]);
        }

        // If not AJAX, fall back to the original redirect
        return back()->with('success', 'Message has been sent!');
    }
}