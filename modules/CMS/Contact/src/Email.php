<?php

namespace CMS\Contact;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';
    
    protected $fillable = ['name', 'email', 'message'];
    
    public static function getEmails() {
        $emails = Email::orderBy('created_at', 'desc')->paginate(10);
        
        return $emails;
    }
}
