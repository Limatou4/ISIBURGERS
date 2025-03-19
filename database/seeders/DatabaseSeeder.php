<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création des rôles
        Role::create(['name' => 'Gestionnaire']);
        Role::create(['name' => 'Client']);

        // Création d'un utilisateur de test
        $user = User::factory()->create([
            'name' => 'Halimatou',
            'email' => '996220.lima@gmail.com',
        ]);

        // Assigner un rôle à l'utilisateur (par exemple "Gestionnaire")
        $user->assignRole('Gestionnaire');
    }
}
