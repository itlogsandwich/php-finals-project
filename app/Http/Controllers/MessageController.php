<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messageShow()
    {
        return view ('conversations.message');
    }
}
