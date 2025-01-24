<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Получить все сообщения пользователя
        $messages = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
    }


    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('messages.create', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return redirect()->route('messages.sent')->with('success', 'Message sent successfully!');
    }

    public function inbox()
    {
        // Получить входящие сообщения для текущего пользователя
        $messages = Message::where('receiver_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('messages.inbox', compact('messages'));
    }

    public function sent()
    {
        // Получить исходящие сообщения для текущего пользователя
        $messages = Message::where('sender_id', auth()->id())->orderBy('created_at', 'desc')->get();

        return view('messages.sent', compact('messages'));
    }
}
