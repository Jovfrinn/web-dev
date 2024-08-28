<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([[
            'name_categories' => 'Makanan',
            'created_at' => now(),
        ],[
            'name_categories' => 'Minuman',
            'created_at' => now(),
        ],[
            'name_categories' => 'Perlengkapan Sekolah',
            'created_at' => now(),
        ],[
            'name_categories' => 'Fashion',
            'created_at' => now(),
        ]]);
    }
}
