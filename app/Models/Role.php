<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Indiquer les colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'nom',
    ];

    // Relation avec les utilisateurs
    // Un rôle peut être associé à plusieurs utilisateurs
    public function users()
    {
        return $this->hasMany(User::class);  // Un rôle peut avoir plusieurs utilisateurs
    }
}
