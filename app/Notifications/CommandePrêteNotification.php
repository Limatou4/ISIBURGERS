<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CommandePrêteNotification extends Notification
{
    protected $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Votre commande est prête.')
            ->action('Voir la commande', url('/commandes/'.$this->commande->id))
            ->line('Merci d\'avoir commandé chez nous!');
    }
}
