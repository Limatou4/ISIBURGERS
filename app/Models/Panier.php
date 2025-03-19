<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;  // Utilisation du trait HasFactory pour les usines

    // Table associée à ce modèle
    protected $table = 'panier';  // Assurez-vous que le nom de la table est correct

    // Colonnes qui peuvent être assignées en masse
    protected $fillable = ['user_id', 'burger_id', 'quantite', 'prix_total'];

    // Relations avec d'autres modèles
    public function user()
    {
        // Un panier appartient à un utilisateur
        return $this->belongsTo(User::class);
    }

    public function burger()
    {
        // Un panier contient un burger
        return $this->belongsTo(Burger::class);
    }

    // Optionnel : Vous pouvez ajouter des accesseurs pour calculer des valeurs dérivées
    public function getTotalAttribute()
    {
        return $this->quantite * $this->prix_total;
    }
}
