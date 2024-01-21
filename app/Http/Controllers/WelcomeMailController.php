<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    class WelcomeMailController extends Controller
    {
        public function index() {
            $passingDataToView = 'Simple Mail Send In Laravel!';
            $data["email"] = 'test@mail.com';
            $data["title"] = "Mail Testing";

            Mail::send('mail.simplemail', ['passingDataToView'=> $passingDataToView], function ($message) use ($data){
                $message->to($data["email"],'John Doe');
                $message->subject($data["title"]);
            });;

            return 'Mail Sent';
        }
    }