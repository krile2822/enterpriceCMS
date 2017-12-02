<?php

namespace CMS\Contact\Controllers;

use Illuminate\Http\Request;
use CMS\Contact\Email;

class ViewController extends Controller {
	
	public function getSelectedMail(Request $request) {
        $mail = Email::findOrFail($request['id']);
        return view('Contact::one-mail', compact('mail'));
    }
}