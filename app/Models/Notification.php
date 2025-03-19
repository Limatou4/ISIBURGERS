<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Spécifie la table correspondante
    protected $table = 'notifications';

    // Si tu veux ignorer la gestion automatique des timestamps (created_at, updated_at)
    // tu peux les désactiver en ajoutant la ligne suivante
    public $timestamps = true; // Cela permet à Laravel de gérer les colonnes created_at et updated_at automatiquement

    // Définit les champs qui peuvent être remplis (mass assignable)
    protected $fillable = [
        'commande_id',
        'message',
        'lue',
    ];

    // Relation avec la commande (optionnel si tu veux accéder à la commande liée à la notification)
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
}
