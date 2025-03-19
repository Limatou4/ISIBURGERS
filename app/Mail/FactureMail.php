<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FactureMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $pdfPath;

    public function __construct($commande, $pdfPath)
    {
        $this->commande = $commande;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Votre Facture ISI BURGER')
                    ->view('emails.facture')
                    ->attach($this->pdfPath, [
                        'as' => 'facture_'.$this->commande->id.'.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
