<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;

// !
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function store()
    {

        $data = request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // ! Email Send
        Mail::to('test@test.com')->send(new ContactFormMail($data));

        return redirect('/')->with(['success','Thank You']);
    }
}
