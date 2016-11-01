<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
	public function send(Request $request) {

        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('email.send', ['title' => $title, 'content' => $content], function ($message)
        {

        	// $message->from('ulti40@hotmail.com', 'Jos');
            $message->to('ulti40@hotmail.com');

        });

        return response()->json(['message' => 'Request completed']);
	}
}
