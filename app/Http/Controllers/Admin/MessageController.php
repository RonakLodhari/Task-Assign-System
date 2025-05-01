<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        try {
            $users = User::where('id', '!=', auth()->id())
                        ->orderBy('fullname')
                        ->get();

            $messages = Message::with(['sender', 'receiver'])
                        ->where(function($query) {
                            $query->whereNull('receiver_id')
                                  ->orWhere('receiver_id', auth()->id())
                                  ->orWhere('sender_id', auth()->id());
                        })
                        ->latest()
                        ->get();

            return view('admin.discussion.index', compact('users', 'messages'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load messages. Please try again.');
        }
    }

    public function send(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000',
                'receiver_id' => 'nullable|exists:users,id'
            ]);

            Message::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id ?: null,
                'message' => $request->message,
            ]);

            return back()->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send message. Please try again.');
        }
    }

    public function delete($id)
    {
        try {
            $message = Message::where('id', $id)
                            ->where('sender_id', auth()->id())
                            ->firstOrFail();

            $message->delete();
            return back()->with('success', 'Message deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete message.');
        }
    }

    public function markAsRead($id)
    {
        try {
            $message = Message::where('id', $id)
                            ->where('receiver_id', auth()->id())
                            ->firstOrFail();

            $message->update(['read_at' => now()]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    public function getUnreadCount()
    {
        try {
            $count = Message::where('receiver_id', auth()->id())
                           ->whereNull('read_at')
                           ->count();

            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            return response()->json(['count' => 0], 500);
        }
    }

    public function clearChat()
    {
        try {
            Message::where(function($query) {
                $query->where('sender_id', auth()->id())
                      ->orWhere('receiver_id', auth()->id());
            })->delete();

            return back()->with('success', 'Chat history cleared successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to clear chat history.');
        }
    }
}