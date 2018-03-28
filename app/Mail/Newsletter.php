<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;


    public $title;
    public $content;
    public $mail;
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $content, $mail, $code)
    {
        $this->title = $title;
        $this->content = $content;
        $this->mail = $mail;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
                ->view('emails.newsletter');
    }
}
