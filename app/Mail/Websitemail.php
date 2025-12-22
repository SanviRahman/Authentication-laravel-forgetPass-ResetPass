<?php
// app/Mail/Websitemail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Websitemail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $link; // লিংক আলাদা ভেরিয়েবলে রাখো

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $link = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->link = $link;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('email') // views/email.blade.php
                    ->with([
                        'subject' => $this->subject,
                        'body' => $this->body,
                        'link' => $this->link, // লিংকটা আলাদা ভাবে পাঠাও
                    ]);
    }
}