<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $content;

    public function __construct($maildata)
    {
        $this->subject = $maildata['subject'];
        $this->content = $maildata['content'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.pomail')
                    ->with([
                        'content' => $this->content
                    ])
                    ->from('no-reply@invizz.io', 'INVIZZ Team')
                    ->subject($this->subject);
    }
}
