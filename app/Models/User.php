<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Ajout du trait
use Illuminate\Notifications\Notifiable;
use App\Models\Panier;
class User extends Authenticatable  // Le modèle User étend désormais Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // Table correspondante dans la base de données
    protected $primaryKey = 'id'; // Si la clé primaire est différente de l'ID
    public $timestamps = true; // Pour gérer created_at et updated_at

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image', // N'oubliez pas d'ajouter les champs requis
    ];

    protected $hidden = [
        'password', // Masquer le mot de passe lors de la sérialisation
    ];

    // Suppression de la logique de hachage du mot de passe
    public static function boot()
    {
        parent::boot();

        // Pas de hachage du mot de passe ici
        static::creating(function ($user) {
            // Laisser le mot de passe tel quel, sans hachage
        });
    }

    
    public function panier()
    {
        return $this->hasMany(Panier::class);
    }

    public function commandes()
{
    return $this->hasMany(Commande::class);
}

}
