<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = [
            // Standard letter sizes
            ['size_name' => 'XXS'],
            ['size_name' => 'XS'],
            ['size_name' => 'S'],
            ['size_name' => 'M'],
            ['size_name' => 'L'],
            ['size_name' => 'XL'],
            ['size_name' => 'XXL'],
            ['size_name' => '3XL'],
            ['size_name' => '4XL'],

            // Numeric sizes
            ['size_name' => '2'],
            ['size_name' => '4'],
            ['size_name' => '6'],
            ['size_name' => '8'],
            ['size_name' => '10'],
            ['size_name' => '12'],
            ['size_name' => '14'],
            ['size_name' => '16'],
            ['size_name' => '18'],
            ['size_name' => '20'],

            // European sizes
            ['size_name' => 'EU 34'],
            ['size_name' => 'EU 36'],
            ['size_name' => 'EU 38'],
            ['size_name' => 'EU 40'],
            ['size_name' => 'EU 42'],
            ['size_name' => 'EU 44'],
            ['size_name' => 'EU 46'],

            // Waist sizes
            ['size_name' => '28W'],
            ['size_name' => '30W'],
            ['size_name' => '32W'],
            ['size_name' => '34W'],
            ['size_name' => '36W'],
            ['size_name' => '38W'],
            ['size_name' => '40W'],

            // Children's sizes
            ['size_name' => '2T'],
            ['size_name' => '3T'],
            ['size_name' => '4T'],
            ['size_name' => '5T'],
            ['size_name' => '6T'],

            // One size options
            ['size_name' => 'One Size'],
            ['size_name' => 'Free Size'],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}
