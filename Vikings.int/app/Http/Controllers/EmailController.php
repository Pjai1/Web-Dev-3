<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
	public function send() {

        $data = ['name' => 'Jos'];

        Mail::send('email.send', $data, function($message) {
            $message->to('jonas.vaneeckhout@student.kdg.be','Joske')->subject('Send Mail from Laravel with Basics Email');
            // $message->from('ulti40@gmail.com','Jos');
        });

        return response()->json(['message' => 'Mail sent to Jos']);
	}
}
