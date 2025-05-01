<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Auth;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get(); 
        $messages = Message::where(function ($query) {
            $query->where('receiver_id', Auth::id()) 
                  ->orWhereNull('receiver_id'); 
        })->orderBy('created_at', 'asc')->get(); 
    
        if (auth()->user()->role === 'admin') {
            return view('admin.discussion.index', compact('users', 'messages'));
        } else {
            return view('user.discussion.index', compact('users', 'messages'));
        }
    }
    
    public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'receiver_id' => 'nullable|exists:users,id', 
    ]);

    Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id ?: null,
        'message' => $request->message,
    ]);

    return redirect()->back()->with('success', 'Message sent successfully!');
}

    public function destroy(Message $message)
    {
        if ($message->sender_id !== Auth::id()) {
            return back()->with('error', 'You can only delete your own messages');
        }

        $message->delete();
        return back()->with('success', 'Message deleted successfully');
    }
}
