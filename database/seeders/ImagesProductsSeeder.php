<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images_products')->insert([[
            'imageName' => 'Nabati.jpeg',
            'is_thumb' => '1',
            'id_product' => 1,
            'created_at' => now(),
        ],[
            'imageName' => 'leminerale.jpeg',
            'is_thumb' => '1',
            'id_product' => 2,
            'created_at' => now(),
        ],[
            'imageName' => 'buku-gambar.jpeg',
            'is_thumb' => '1',
            'id_product' => 3,
            'created_at' => now(),
        ]]);
    }
}
