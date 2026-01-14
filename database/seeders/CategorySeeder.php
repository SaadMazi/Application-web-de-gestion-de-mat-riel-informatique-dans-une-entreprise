<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // On crée plusieurs catégories d'un coup
        $categories = [
            'Ordinateur Portable',
            'Unité Centrale',
            'Écran',
            'Clavier / Souris',
            'Imprimante',
            'Réseau (Switch/Routeur)'
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}
