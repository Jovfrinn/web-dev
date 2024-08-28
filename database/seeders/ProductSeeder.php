<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([[
            'name_product' => 'Nabati',
            'description_product' => 'Nabati enak',
            'price' => 2000,
            'stock' => 100,
            'category_id' => 1,
        ],[
            'name_product' => 'Le Minerale',
            'description_product' => 'Minuman ada manis manisnya.',
            'price' => 3000,
            'stock' => 50,
            'category_id' => 2,
        ],[
            'name_product' => 'Buku Gambar',
            'description_product' => 'ukuran A4',
            'price' => 5000,
            'stock' => 10,
            'category_id' => 3,
        ]]);
    }
}
