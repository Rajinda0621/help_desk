<?php

namespace App\Http\Controllers;

use App\Mail\SendWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(){
        try{
            $toEmailAddress = "rajindasamarasinghe0621@gmail.com";
            $welcomeMessage = "Welcome to Help Desk";
            Mail::to($toEmailAddress)->send(new SendWelcomeMail($welcomeMessage));
        }
        catch(\Exception $e){

        }
    }
}
