<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeBurger extends Model
{
    use HasFactory;

    // Indiquer les colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'commande_id', 
        'burger_id',
        'quantite',
    ];

    // Relation avec la commande
    public function commande()
    {
        return $this->belongsTo(Commande::class); // Chaque commande_burger appartient à une commande
    }

    // Relation avec le burger
    public function burger()
    {
        return $this->belongsTo(Burger::class); // Chaque commande_burger appartient à un burger
    }
}
