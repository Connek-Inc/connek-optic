<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing materials to avoid duplicates if re-running without fresh
        // Material::truncate(); // Be careful with foreign keys, better to just create if not exists or assume fresh db

        // 1. Lens Materials (Type of plastic/glass)
        $lensMaterials = [
            ['name' => 'Organique (CR-39)', 'price' => 0.00, 'description' => 'Standard, économique'],
            ['name' => 'Polycarbonate', 'price' => 30.00, 'description' => 'Résistant aux impacts, léger'],
            ['name' => 'Trivex', 'price' => 45.00, 'description' => 'Léger, optique supérieure, résistant'],
            ['name' => 'Hi-Index 1.67', 'price' => 80.00, 'description' => 'Pour fortes corrections, fin'],
            ['name' => 'Hi-Index 1.74', 'price' => 120.00, 'description' => 'Ultra fin'],
        ];

        foreach ($lensMaterials as $m) {
            Material::firstOrCreate(
                ['name' => $m['name'], 'type' => 'material_lens'],
                ['price' => $m['price'], 'description' => $m['description'], 'stock' => 100]
            );
        }

        // 2. Frame Types
        $frameTypes = [
            ['name' => 'Plastique / Acétate', 'price' => 0.00, 'description' => 'Styles variés, couleurs riches'],
            ['name' => 'Métal', 'price' => 0.00, 'description' => 'Fin, discret, ajustable'],
            ['name' => 'Titane', 'price' => 50.00, 'description' => 'Ultra léger, hypoallergénique, durable'],
            ['name' => 'Semi-cerclée (Nylor)', 'price' => 0.00, 'description' => 'Champ de vision dégagé en bas'],
            ['name' => 'Percée (Sans monture)', 'price' => 30.00, 'description' => 'Invisible, très léger'],
        ];

        foreach ($frameTypes as $f) {
            Material::firstOrCreate(
                ['name' => $f['name'], 'type' => 'frame_type'],
                ['price' => $f['price'], 'description' => $f['description'], 'stock' => 100]
            );
        }

        // 3. Lens Indexes (Thicknes)
        $indexes = [
            ['name' => '1.50 (Standard)', 'price' => 0.00, 'description' => 'Inclus de base'],
            ['name' => '1.56 (Fin)', 'price' => 20.00, 'description' => 'Légèrement aminci'],
            ['name' => '1.60 (Très Fin)', 'price' => 45.00, 'description' => 'Recommandé pour +/- 4.00'],
            ['name' => '1.67 (Ultra Fin)', 'price' => 90.00, 'description' => 'Recommandé pour +/- 6.00'],
            ['name' => '1.74 (Extra Fin)', 'price' => 145.00, 'description' => 'Pour très fortes corrections'],
        ];

        foreach ($indexes as $i) {
            Material::firstOrCreate(
                ['name' => $i['name'], 'type' => 'lens_index'],
                ['price' => $i['price'], 'description' => $i['description'], 'stock' => 100]
            );
        }

        // 4. Lens Options / Treatments
        $options = [
            ['name' => 'Anti-Rayures (Durci)', 'price' => 20.00, 'description' => 'Protection de base'],
            ['name' => 'Anti-Reflet Standard', 'price' => 35.00, 'description' => 'Réduit l\'éblouissement'],
            ['name' => 'Anti-Reflet Premium', 'price' => 60.00, 'description' => 'Hydrophobe, oléophobe, antistatique'],
            ['name' => 'Filtre Lumière Bleue', 'price' => 40.00, 'description' => 'Protection écrans'],
            ['name' => 'Photochromique (Transition)', 'price' => 95.00, 'description' => 'Teinte au soleil'],
            ['name' => 'Teinte Solaire', 'price' => 30.00, 'description' => 'Lunette de soleil permanente'],
            ['name' => 'Polarisé', 'price' => 80.00, 'description' => 'Élimine l\'éblouissement (Solaire)'],
        ];

        foreach ($options as $o) {
            Material::firstOrCreate(
                ['name' => $o['name'], 'type' => 'lens_option'],
                ['price' => $o['price'], 'description' => $o['description'], 'stock' => 100]
            );
        }
    }
}
