<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MessageController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function index(){
        $messages = Message::with('sender')->orderBy('created_at', 'desc')->get();
        return $messages;
    }

    public function show($message_id){
        $message = Message::with('sender')->find($message_id);

        // Change status as seen
        if(!$message->is_seen){
            $this->seen($message->id);
        }

        return $message;
    }

    public function seen($message_id){
        Message::where('id', $message_id)->update(['is_seen' => 1]);
    }
}
