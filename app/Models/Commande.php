<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    // Indiquer les colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'user_id',
        'statut',
        'total',
        'methode_paiement', // Ajout de la méthode de paiement
        'nomproduit', // Ajout de la colonne nomproduit
    ];

    // Si tu utilises des types spécifiques dans la base de données, tu peux les spécifier ici
    protected $casts = [
        'total' => 'decimal:2', // Pour que le total soit un nombre décimal avec 2 décimales
    ];

    // Relation avec l'utilisateur (user)
    public function user()
    {
        return $this->belongsTo(User::class); // Une commande appartient à un utilisateur
    }
}
