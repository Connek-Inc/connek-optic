<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        // 2 Pairs - Standard ($300)
        Promotion::create([
            'name' => '2 Paires - Standard ($300)',
            'price' => 300.00,
            'description' => 'Montures + Verres + Antireflet + Résistant aux rayures',
            'type' => 'simple',
            'features' => ['Montures', 'Verres', 'Antireflet', 'Résistant aux rayures'],
            'active' => true,
        ]);

        // 2 Pairs - Blue Protection ($350)
        Promotion::create([
            'name' => '2 Paires - Protection ($350)',
            'price' => 350.00,
            'description' => 'Standard + Protection lumière bleue',
            'type' => 'simple',
            'features' => ['Montures', 'Verres', 'Antireflet', 'Résistant aux rayures', 'Protection lumière bleue'],
            'active' => true,
        ]);

        // 2 Pairs - Photochromic/Tint ($395)
        Promotion::create([
            'name' => '2 Paires - Photochromique ($395)',
            'price' => 395.00,
            'description' => 'Protection + Photochromique ou teinte',
            'type' => 'simple',
            'features' => ['Montures', 'Verres', 'Antireflet', 'Résistant aux rayures', 'Protection lumière bleue', 'Photochromique ou teinte'],
            'active' => true,
        ]);

        // Progressive - OPTI-W PLUS (+$50 upgrade usually, but modeled as promo package base for now or separate?)
        // The image shows these as "Seulement chez OPTI-W". 
        // Let's create them as base progressive options.

        Promotion::create([
            'name' => 'OPTI-W PLUS (Progressif)',
            'price' => 350.00, // Assuming base 300 + 50
            'description' => 'Vision: Distance, Intermédiaire, Proche. Champ large.',
            'type' => 'progressif',
            'features' => ['Champ Large', '3 Zones de confort'],
            'active' => true,
        ]);

        Promotion::create([
            'name' => 'OPTI-W MAX (Progressif)',
            'price' => 400.00, // Assuming base 300 + 100
            'description' => 'Vision Premium. Le champ de vision le plus large.',
            'type' => 'progressif',
            'features' => ['Champ MAX', 'Confort Ultime'],
            'active' => true,
        ]);
    }
}
