<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure categories exist
        $catFrames = Category::firstOrCreate(['name' => 'Monturas']);
        $catSunglasses = Category::firstOrCreate(['name' => 'Gafas de Sol']);

        // 1. Ray-Ban Aviator
        Product::updateOrCreate(['sku' => 'RB3025-L0205'], [
            'name' => 'Aviator Classic',
            'brand' => 'Ray-Ban',
            'product_type' => 'frame',
            'price' => 163.00,
            'stock_quantity' => 15,
            'category_id' => $catSunglasses->id,
            'description' => 'Originalmente diseñadas para los aviadores de EE. UU. en 1937, las gafas de sol Ray-Ban Aviator Classic son ahora uno de los modelos de gafas de sol más icónicos del mundo.',
            'image_path' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=800&auto=format&fit=crop', // Placeholder Unsplash
            'specs' => [
                'material' => 'Metal',
                'shape' => 'Piloto',
                'bridge_size' => 14,
                'lens_width' => 58,
                'temple_length' => 135
            ]
        ]);

        // 2. Ray-Ban Wayfarer
        Product::updateOrCreate(['sku' => 'RB2140-901'], [
            'name' => 'Original Wayfarer Classic',
            'brand' => 'Ray-Ban',
            'product_type' => 'frame',
            'price' => 163.00,
            'stock_quantity' => 8,
            'category_id' => $catSunglasses->id,
            'description' => 'Ray-Ban Original Wayfarer Classics son el estilo más reconocible en la historia de las gafas de sol.',
            'image_path' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?q=80&w=800&auto=format&fit=crop',
            'specs' => [
                'material' => 'Acetato',
                'shape' => 'Cuadrada',
                'bridge_size' => 22,
                'lens_width' => 50,
                'temple_length' => 150
            ]
        ]);

        // 3. Oakley Holbrook
        Product::updateOrCreate(['sku' => 'OO9102-01'], [
            'name' => 'Holbrook',
            'brand' => 'Oakley',
            'product_type' => 'frame',
            'price' => 156.00,
            'stock_quantity' => 20,
            'category_id' => $catSunglasses->id,
            'description' => 'Un diseño clásico y atemporal fusionado con la tecnología moderna de Oakley. Inspirado en los héroes de la pantalla de los años 40, 50 y 60.',
            'image_path' => 'https://images.unsplash.com/photo-1577803645773-f96470509666?q=80&w=800&auto=format&fit=crop',
            'specs' => [
                'material' => 'O Matter',
                'shape' => 'Cuadrada',
                'bridge_size' => 18,
                'lens_width' => 55,
                'temple_length' => 137
            ]
        ]);

        // 4. Gucci GG0061S
        Product::updateOrCreate(['sku' => 'GG0061S-001'], [
            'name' => 'GG0061S Round',
            'brand' => 'Gucci',
            'product_type' => 'frame',
            'price' => 350.00,
            'stock_quantity' => 5,
            'category_id' => $catFrames->id, // Could be optical frame
            'description' => 'Montura redonda de metal dorado con detalles de la tribanda web de Gucci.',
            'image_path' => 'https://images.unsplash.com/photo-1591076482161-42ce6da69f67?q=80&w=800&auto=format&fit=crop',
            'specs' => [
                'material' => 'Metal',
                'shape' => 'Redonda',
                'bridge_size' => 22,
                'lens_width' => 56,
                'temple_length' => 140
            ]
        ]);

        // 5. Tom Ford
        Product::updateOrCreate(['sku' => 'FT5532-B'], [
            'name' => 'Blue Block Round',
            'brand' => 'Tom Ford',
            'product_type' => 'frame',
            'price' => 295.00,
            'stock_quantity' => 12,
            'category_id' => $catFrames->id,
            'description' => 'Monturas ópticas con filtro de luz azul incluido. Diseño sofisticado característico de Tom Ford.',
            'image_path' => 'https://plus.unsplash.com/premium_photo-1675716443562-b771d72a3da7?q=80&w=800&auto=format&fit=crop',
            'specs' => [
                'material' => 'Acetato',
                'shape' => 'Pantoscópica',
                'bridge_size' => 21,
                'lens_width' => 49,
                'temple_length' => 145
            ]
        ]);

        // 6. Generic Titanium
        Product::updateOrCreate(['sku' => 'AIR-TI-001'], [
            'name' => 'Titanium Air',
            'brand' => 'Lumine',
            'product_type' => 'frame',
            'price' => 120.00,
            'stock_quantity' => 30,
            'category_id' => $catFrames->id,
            'description' => 'Montura de titanio ultra ligera, flexible y resistente. Perfecta para uso diario prolongado.',
            'image_path' => 'https://images.unsplash.com/photo-1563903530908-1724691079d8?q=80&w=800&auto=format&fit=crop',
            'specs' => [
                'material' => 'Titanio',
                'shape' => 'Rectangular',
                'bridge_size' => 17,
                'lens_width' => 54,
                'temple_length' => 140
            ]
        ]);
    }
}
