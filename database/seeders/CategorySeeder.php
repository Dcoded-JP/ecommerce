<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Men's Clothing
            ['category_name' => "Men's T-Shirts"],
            ['category_name' => "Men's Shirts"],
            ['category_name' => "Men's Jeans"],
            ['category_name' => "Men's Pants"],
            ['category_name' => "Men's Suits"],
            ['category_name' => "Men's Jackets"],
            ['category_name' => "Men's Sweaters"],
            ['category_name' => "Men's Hoodies"],
            ['category_name' => "Men's Activewear"],
            ['category_name' => "Men's Underwear"],

            // Women's Clothing
            ['category_name' => "Women's Dresses"],
            ['category_name' => "Women's Tops"],
            ['category_name' => "Women's Blouses"],
            ['category_name' => "Women's Skirts"],
            ['category_name' => "Women's Jeans"],
            ['category_name' => "Women's Pants"],
            ['category_name' => "Women's Jackets"],
            ['category_name' => "Women's Sweaters"],
            ['category_name' => "Women's Activewear"],
            ['category_name' => "Women's Lingerie"],

            // Kids' Clothing
            ['category_name' => "Boys' T-Shirts"],
            ['category_name' => "Boys' Pants"],
            ['category_name' => "Boys' Jackets"],
            ['category_name' => "Girls' Dresses"],
            ['category_name' => "Girls' Tops"],
            ['category_name' => "Girls' Skirts"],

            // Seasonal
            ['category_name' => 'Winter Wear'],
            ['category_name' => 'Summer Collection'],
            ['category_name' => 'Spring Fashion'],
            ['category_name' => 'Fall Essentials'],

            // Accessories
            ['category_name' => 'Scarves'],
            ['category_name' => 'Belts'],
            ['category_name' => 'Ties'],
            ['category_name' => 'Hats'],

            // Special Categories
            ['category_name' => 'Formal Wear'],
            ['category_name' => 'Casual Wear'],
            ['category_name' => 'Sports Wear'],
            ['category_name' => 'Ethnic Wear'],
            ['category_name' => 'Beach Wear'],
            ['category_name' => 'Sleep Wear'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
