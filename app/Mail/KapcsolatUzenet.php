<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KapcsolatUzenet extends Mailable
{
    use Queueable, SerializesModels;

    public $adatok;

    public function __construct($adatok)
    {
        $this->adatok = $adatok;
    }

    public function build()
    {
        return $this->subject('Új weboldalas üzenet: ' . $this->adatok['subject'])
                    ->replyTo($this->adatok['email']) // Így a szalon egyből tud "Válaszolni" az e-mailre
                    ->markdown('emails.kapcsolat_uzenet'); 
    }
}