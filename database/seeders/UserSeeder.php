<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            [
                "name" => "admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt('admin123'),
                "id_role" => 2,
                "created_at" => now()
            ],
            [
                "name" => "user",
                "email" => "user@gmail.com",
                "password" => bcrypt('user123'),
                "id_role" => 1,
                "created_at" => now()
            ],
            ];

            DB::table('users')->insert($array);
    }
}
