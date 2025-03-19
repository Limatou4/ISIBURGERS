<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    use HasFactory;

    protected $table = 'burgers';

    protected $fillable = [
        'nom',
        'prix',
        'image',
        'description',
        'stock',
        'archived',
    ];
}
