<?php

namespace CMS\Contact\Controllers;

use Illuminate\Http\Request;
use CMS\Contact\ContactEmailMailable;
use CMS\Contact\Email;
use CMS\admin\Settings;
use Mail;

class ContactController extends Controller {
	
	public static function leaveMessage(Request $request) {
        
        $email = $request->email;
        $name = $request->name;
        $message = $request->message;
        
        $contact_message = Email::create([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
        
        $owner = Settings::where('name', 'email_address_for_feedback')->pluck('content');
        Mail::to($owner)->send(new ContactEmailMailable($contact_message));
        return response()->json(['msg' => 'success']);
    }
}