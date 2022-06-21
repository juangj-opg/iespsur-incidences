<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyMail;

class SendEmailController extends Controller
{
    public function index()
    {
        Mail::to('juangj1b@gmail.com')->send(new NotifyMail());
    }
}
