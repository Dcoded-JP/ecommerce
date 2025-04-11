<?php

namespace Database\Seeders;

use Faker\Core\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::where('id', '>', 0)->delete();
        $products = [
            [
                'sub_title' => 'Zalando',
                'name' => 'Relaxed corduroy shirt',
                'sku' => 'M492300',
                'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry lorem ipsum standard.',
                'price' => 49.99,
                'category' => 'Men',
                'color' => 'Blue, Green, Red, Yellow, Orange, Purple, Pink, Brown, Black, White',
                'size' => 'M, L, XL, XXL',
                'image' => 'images/demo-fashion-store-product-01.webp'
            ],
            [
                'sub_title' => 'Zalando',
                'name' => 'Relaxed corduroy shirt',
                'sku' => 'M492300',
                'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry lorem ipsum standard.',
                'price' => 79.99,
                'category' => 'Women',
                'color' => 'Blue, Green, Red, Yellow, Orange, Purple, Pink, Brown, Black, White',
                'size' => 'M, L, XL, XXL',
                'image' => 'images/demo-fashion-store-product-02.webp'
            ],
            [
                'sub_title' => 'Zalando',
                'name' => 'Relaxed corduroy shirt',
                'sku' => 'M492300',
                'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry lorem ipsum standard.',
                'price' => 29.99,
                'category' => 'Kids',
                'color' => 'Blue, Green, Red, Yellow, Orange, Purple, Pink, Brown, Black, White',
                'size' => 'M, L, XL, XXL',
                'image' => 'images/demo-fashion-store-product-03.webp'
            ],
            [
                'sub_title' => 'Zalando',
                'name' => 'Relaxed corduroy shirt',
                'sku' => 'M492300',
                'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry lorem ipsum standard.',
                'price' => 29.99,
                'category' => 'Accessories',
                'image' => 'images/demo-fashion-store-product-04.webp'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
