<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        Template::create([
            'name' => 'Kotak Donat',
            'image_path' => '1.png',
            'image_cover' => '1b.png',
            'jenis' => 'kotak',
            'is_paid' => true,
            'usage_count' => 55,
        ]);
        Template::create([
            'name' => 'Kotak Korek',
            'image_path' => '2.png',
            'image_cover' => '2b.png',
            'jenis' => 'kotak',
            'is_paid' => false,
            'usage_count' => 8,
        ]);
        Template::create([
            'name' => 'Kotak Kaya',
            'image_path' => '3.png',
            'jenis' => 'kotak',
            'image_cover' => '3b.png',
            'is_paid' => true,
            'usage_count' => 25,
        ]);
        Template::create([
            'name' => 'Kotak Hadiah',
            'image_path' => '4.png',
            'image_cover' => '4b.png',
            'jenis' => 'kotak',
            'is_paid' => false,
            'usage_count' => 5,
        ]);
        Template::create([
            'name' => 'Kotak Panjang',
            'image_path' => '5.png',
            'jenis' => 'kotak',
            'image_cover' => '5b.png',
            'is_paid' => false,
            'usage_count' => 23,
        ]);
        Template::create([
            'name' => 'Kotak Makanan Kucing',
            'image_path' => '6.png',
            'image_cover' => '6b.png',
            'jenis' => 'kotak',
            'is_paid' => true,
            'usage_count' => 3,
        ]);
        Template::create([
            'name' => 'Kotak Nikah',
            'image_path' => '7.png',
            'jenis' => 'kotak',
            'image_cover' => '7b.png',
            'is_paid' => true,
            'usage_count' => 38,
        ]);
        
        // stiker
        Template::create([
            'name' => 'Siker Hijau',
            'image_path' => 'stiker1.png',
            'image_cover' => 'stiker1b.png',
            'jenis' => 'stiker',
            'is_paid' => false,
            'usage_count' => 38,
        ]);
        Template::create([
            'name' => 'Stiker Lingkaran',
            'image_path' => 'stiker2.png',
            'jenis' => 'stiker',
            'image_cover' => 'stiker2b.png',
            'is_paid' => false,
            'usage_count' => 18,
        ]);
        Template::create([
            'name' => 'Stiker Pisang',
            'image_path' => 'stiker3.png',
            'jenis' => 'stiker',
            'image_cover' => '7b.png',
            'is_paid' => true,
            'usage_count' => 138,
        ]);
        Template::create([
            'name' => 'Stiker Kacang',
            'image_path' => 'stiker4.png',
            'image_cover' => 'stiker4b.png',
            'jenis' => 'stiker',
            'is_paid' => true,
            'usage_count' => 618,
        ]);
        Template::create([
            'name' => 'Stiker Coklat',
            'jenis' => 'stiker',
            'image_path' => 'stiker5.png',
            'image_cover' => 'stiker5b.png',
            'is_paid' => true,
            'usage_count' => 1538,
        ]);

    }
}
