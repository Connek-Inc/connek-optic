<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Sale;
use App\Models\Material;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'),
            ]
        );

        // 2. Materials (Stock/Inventory)
        $materials = [
            ['name' => 'Organique CR39', 'type' => 'material_lens', 'price' => 0, 'stock' => 100],
            ['name' => 'Polycarbonate', 'type' => 'material_lens', 'price' => 30, 'stock' => 80],
            ['name' => 'High Index 1.67', 'type' => 'material_lens', 'price' => 60, 'stock' => 50],

            ['name' => 'Métal Complet', 'type' => 'frame_type', 'price' => 0, 'stock' => 200],
            ['name' => 'Acétate', 'type' => 'frame_type', 'price' => 10, 'stock' => 150],
            ['name' => 'Nylor (Fil)', 'type' => 'frame_type', 'price' => 20, 'stock' => 100],
            ['name' => 'Percée (Sans monture)', 'type' => 'frame_type', 'price' => 50, 'stock' => 50],

            ['name' => '1.50 Standard', 'type' => 'lens_index', 'price' => 0, 'stock' => 999],
            ['name' => '1.60 Aminci', 'type' => 'lens_index', 'price' => 50, 'stock' => 999],
            ['name' => '1.67 Extra Fin', 'type' => 'lens_index', 'price' => 100, 'stock' => 999],
            ['name' => '1.74 Ultra Fin', 'type' => 'lens_index', 'price' => 150, 'stock' => 999],

            ['name' => 'Antireflet Std', 'type' => 'lens_option', 'price' => 20, 'stock' => 999],
            ['name' => 'BlueControl', 'type' => 'lens_option', 'price' => 40, 'stock' => 999],
            ['name' => 'Photochromique', 'type' => 'lens_option', 'price' => 80, 'stock' => 999],
        ];

        foreach ($materials as $mat) {
            Material::firstOrCreate(
                ['name' => $mat['name'], 'type' => $mat['type']],
                ['price' => $mat['price'], 'stock' => $mat['stock'], 'description' => 'Demo Stock']
            );
        }

        // 3. Clients & Sales
        $clients = [
            [
                'name' => 'Marie Dubois',
                'email' => 'marie.d@example.com',
                'phone' => '06 12 34 56 78',
                'prescription' => ['sph_od' => '-1.50', 'sph_og' => '-1.75', 'pd' => '62'],
                'sale_total' => 200,
                'promo' => '2 Paires - Essentiel ($200)',
            ],
            [
                'name' => 'Jean Martin',
                'email' => 'jean.m@example.com',
                'phone' => '06 98 76 54 32',
                'prescription' => ['sph_od' => '+2.00', 'add_od' => '+2.50', 'sph_og' => '+1.75', 'add_og' => '+2.50', 'pd' => '64'],
                'sale_total' => 350,
                'promo' => 'OPTI-W PLUS (+50)',
            ],
            [
                'name' => 'Sophie Leroy',
                'email' => 'sophie.l@example.com',
                'phone' => '07 11 22 33 44',
                'prescription' => ['sph_od' => '-3.25', 'cyl_od' => '-0.75', 'axis_od' => '180', 'sph_og' => '-3.00', 'pd' => '60'],
                'sale_total' => 250,
                'promo' => '2 Paires - Protection ($250)',
            ],
            [
                'name' => 'Lucas Bernard',
                'email' => 'lucas.b@example.com',
                'phone' => '06 55 44 33 22',
                'prescription' => ['sph_od' => '-0.50', 'sph_og' => '-0.50', 'pd' => '66'],
                'sale_total' => 200,
                'promo' => '2 Paires - Essentiel ($200)',
            ],
            [
                'name' => 'Emma Petit',
                'email' => 'emma.p@example.com',
                'phone' => '07 99 88 77 66',
                'prescription' => ['sph_od' => '+0.75', 'sph_og' => '+0.50', 'pd' => '61'],
                'sale_total' => 275,
                'promo' => '2 Paires - Transition ($275)',
            ],
            [
                'name' => 'Thomas Richard',
                'email' => 'thomas.r@example.com',
                'phone' => '06 12 34 56 00',
                'prescription' => ['sph_od' => '-4.00', 'sph_og' => '-4.25', 'pd' => '63'],
                'sale_total' => 300,
                'promo' => 'OPTI-W MAX (+100)',
            ],
        ];

        foreach ($clients as $c) {
            $client = Client::create([
                'name' => $c['name'],
                'email' => $c['email'],
                'phone' => $c['phone'],
                'prescription_details' => json_encode($c['prescription']),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            Sale::create([
                'client_id' => $client->id,
                'total_amount' => $c['sale_total'],
                'status' => 'completed',
                'details' => [
                    'promo' => $c['promo'],
                    'generated_by' => 'Demo Seeder',
                ],
                'created_at' => $client->created_at,
            ]);
        }
    }
}
