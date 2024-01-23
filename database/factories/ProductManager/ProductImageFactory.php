<?php

namespace Database\Factories\ProductManager;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Define your factory logic here
        return [
            'product_id' => function () {
                return \App\Models\ProductManager\Product::factory()->create()->id;
            },
            'url' => $this->faker->imageUrl,
            'color' => $this->faker->colorName,
            'view' => $this->faker->randomElement(['rear', 'side', 'top']),
        ];
    }
}
