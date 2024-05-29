<?php

namespace App\Http\Controllers;

use App\Events\UserOnlined;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat()
    {
        $users = User::where('id', '<>', Auth::user()->id)->get();
        return view('chat/chatpublic', compact('users'));
    }
    public function sendMessage(Request $request)
    {
        // Nhận 2 tham số bên __contructor
        broadcast(new UserOnlined($request->user(), $request->message));

        return json_encode([
            'success' => 'done'
        ]);
    }
}
