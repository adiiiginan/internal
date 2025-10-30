<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PerdinNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $perdin;

    /**
     * Create a new message instance.
     */
    public function __construct($perdin)
    {
        $this->perdin = $perdin;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Perdin Submission')
            ->view('emails.perdin_notification')
            ->with(['perdin' => $this->perdin]);
    }
}
