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
        DB::table('categories')->insert(['name' => 'Audiobook']);
        DB::table('categories')->insert(['name' => 'Biografia']);
        DB::table('categories')->insert(['name' => 'Dla dzieci']);
        DB::table('categories')->insert(['name' => 'Fantastyka']);
        DB::table('categories')->insert(['name' => 'Historia']);
        DB::table('categories')->insert(['name' => 'Informatyka']);
        DB::table('categories')->insert(['name' => 'Komiks']);
        DB::table('categories')->insert(['name' => 'Kryminal']);
        DB::table('categories')->insert(['name' => 'Lektura']);
        DB::table('categories')->insert(['name' => 'Kulinaria']);
        DB::table('categories')->insert(['name' => 'Nauka jezykow']);
        DB::table('categories')->insert(['name' => 'Peozja']);
        DB::table('categories')->insert(['name' => 'Poradniki']);
        DB::table('categories')->insert(['name' => 'Rozwoj osobisty']);
    }
}
