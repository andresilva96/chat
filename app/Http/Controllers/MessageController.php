<?php

namespace App\Http\Controllers;

use App\Events\Chat\SendMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class MessageController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function send(Request $request)
    {
        $message = new Message();
        $message->from = Auth::id();
        $message->to = $request->to;
        $message->content = $request->content;
        $message->save();
        Event::dispatch(new SendMessage($message, $request->to));
        return redirect()->back();
    }
}
