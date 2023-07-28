<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\CPU\Helpers;
use Illuminate\Support\Arr;
use Mail;
use App\Mail\OrderMail;
use DB;
class smtpController extends Controller
{
    public function mail()
    {
        $user_email = 'unitech.zarna@gmail.com';
        $order="";
        Mail::to($user_email)->send(new OrderMail($order));
    }
    
}
