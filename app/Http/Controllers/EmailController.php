<?php

namespace App\Http\Controllers;

use App\Mail\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    static function sendEmail($email, $details)
    {

        return Mail::to($email)->send(new AppMailer($details));
    }
}