<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FoglalasModositva extends Mailable
{
    use Queueable, SerializesModels;

    public $adatok;

    public function __construct($adatok)
    {
        $this->adatok = $adatok;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Időpont sikeresen módosítva - Fresh Szalon',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.modositva',
        );
    }
}