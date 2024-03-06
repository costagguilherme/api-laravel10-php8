<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Tecnologia']);
        Category::create(['name' => 'Gastronomia']);
        Category::create(['name' => 'Futebol']);
        Category::create(['name' => 'Moda']);
        Category::create(['name' => 'Youtube']);
        Category::create(['name' => 'Games']);

    }
}
