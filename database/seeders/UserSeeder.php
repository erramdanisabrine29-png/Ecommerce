<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Créer un rôle admin si pas encore créé
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);

        // ✅ Créer un utilisateur admin
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'], // si déjà exist → skip
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'), // password sécurisé
            ]
        );

        // ✅ Assigner role
        $user->assignRole($roleAdmin);
    }
}