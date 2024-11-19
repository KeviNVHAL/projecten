<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;
use Database\Factories\ImageProvider;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Create a Faker instance
        $faker = Faker::create();
        $faker->addProvider(new ImageProvider($faker));

        // Create 50 dummy products
        foreach (range(1, 100) as $index) {
            Product::create([
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, 1, 1000),
                'description' => $faker->sentence,
                'stock' => $faker->numberBetween(0, 100),
                'type' => $faker->word,
                'picture' => $faker->image_name()
            ]);
        }
    }
}
