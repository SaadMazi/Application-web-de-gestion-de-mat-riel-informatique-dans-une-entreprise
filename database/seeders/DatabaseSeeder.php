<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. On appelle le Seeder qui crée l'Admin (si tu l'as gardé)
        $this->call(AdminSeeder::class);

        // 2. On appelle le Seeder qui crée les Catégories
        $this->call(CategorySeeder::class);

        // Tu pourras ajouter d'autres seeders ici plus tard
    }
}
