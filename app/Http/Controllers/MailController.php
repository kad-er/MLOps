<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller {
    /*public function basic_email() {
       $data = array('name'=>"Virat Gandhi");
    
       Mail::send(['text'=>'mail'], $data, function($message) {
          $message->to('abc@gmail.com', 'Tutorials Point')->subject
             ('Laravel Basic Testing Mail');
          $message->from('xyz@gmail.com','Virat Gandhi');
       });
       echo "Basic Email Sent. Check your inbox.";
    }*/
    public function retview()
    {
        return view('contact');
    }
    public function html_email(Request $request) {
        $name= $request->name;
        $email= $request->email;
        $sub=$request->subject;
        $message=$request->message;
        $data = array('name'=>$name,'email'=>$email,'subject'=>$sub,'message'=>$message);
        Mail::send('mail', ["data"=>$data], function($message) {
            $message->to('tagkader@hotmail.fr', 'Mail from website')->subject
                ('Mail from website');
            $message->from('xyz@gmail.com','MLOps.tk contact form');
       });

       
       echo "HTML Email Sent. Check your inbox.";
    }
    
 }
