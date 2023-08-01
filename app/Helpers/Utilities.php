<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class Utilities
{

 public static function sendMail($template, $to, $subject, $data)
 {

  Mail::send($template, $data->toArray(), function ($message) use ($to, $subject) {
   // $message->from('john@johndoe.com', 'John Doe');
   // $message->sender('john@johndoe.com', 'John Doe');
   $message->to($to, 'John Doe');
   // $message->cc('john@johndoe.com', 'John Doe');
   // $message->bcc('john@johndoe.com', 'John Doe');
   // $message->replyTo('john@johndoe.com', 'John Doe');
   $message->subject($subject);
   // $message->priority(3);
   // $message->attach('pathToFile');
  });
 }
}
