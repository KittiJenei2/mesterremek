<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FoglalasLetrehozva extends Mailable
{
    use Queueable, SerializesModels;

    public $adatok;

    /**
     * Create a new message instance.
     */
    public function __construct($adatok)
    {
        $this->adatok = $adatok;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Foglalás visszaigazolása', // Itt állítjuk a tárgyat
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.foglalas', // Itt állítjuk a nézetet (view.name helyett)
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}