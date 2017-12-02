<?php

namespace CMS\Contact;

use Illuminate\Http\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmailMailable extends Mailable
{
    public $msg;

  use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact_message)
    {
        $this->msg = $contact_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      // send email for owner using details of the $order
      return $this->view('Contact::contact-email-template')->with(['msg' => $this->msg]);
    }
}