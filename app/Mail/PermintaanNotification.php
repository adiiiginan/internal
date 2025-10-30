<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PermintaanNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $permintaan;
    protected $pdf;

    /**
     * Create a new message instance.
     */
    public function __construct($permintaan, $pdf)
    {
        $this->permintaan = $permintaan;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $filename = 'permintaan_barang_' . ($this->permintaan->id ?? time()) . '.pdf';

        $email = $this->subject('Notifikasi Permintaan Barang')
            ->view('emails.permintaan')
            ->with(['permintaan' => $this->permintaan]);

        // Attach PDF if available
        if ($this->pdf && method_exists($this->pdf, 'output')) {
            $email->attachData($this->pdf->output(), $filename, [
                'mime' => 'application/pdf',
            ]);
        } elseif (is_string($this->pdf)) {
            $email->attachData($this->pdf, $filename, [
                'mime' => 'application/pdf',
            ]);
        }

        return $email;
    }
}
