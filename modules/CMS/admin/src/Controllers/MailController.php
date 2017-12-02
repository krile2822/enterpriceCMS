<?php

namespace CMS\admin\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{

    // Email sending
    // NEVER USED YET
    public function mail() {
    	\Mail::send('admin.mail', [], function ($message) {
    		$message->to('krile2822@gmail.com', 'Pinter Krisztian')->subject('Welcome to CMS!');
});

    	return redirect()->route('register');
    }
}
