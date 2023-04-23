<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => rand(1,10),
            "product" => $this->faker->title(),
            "price" => rand(1,500),
            "description" => $this->faker->text(),
            "image_url" => ""
        ];
    }
}
