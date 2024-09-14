<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'Unsorted'],
            ['name' => 'Technology'],
            ['name' => 'Health'],
            ['name' => 'Lifestyle'],
            ['name' => 'Sports'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
