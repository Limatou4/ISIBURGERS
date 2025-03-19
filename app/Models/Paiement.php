<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    // Indiquer les colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'commande_id',
        'montant',
        'date_paiement',
    ];

    // Relation avec la commande
    public function commande()
    {
        return $this->belongsTo(Commande::class); // Chaque paiement appartient à une commande
    }
}
