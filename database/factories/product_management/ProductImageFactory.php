<?php

namespace Database\Factories\product_management;

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
                return \App\Models\product_management\Product::factory()->create()->id;
            },
            'url' => $this->faker->imageUrl,
            'color' => $this->faker->colorName,
            'view' => $this->faker->randomElement(['front', 'side', 'top']),
        ];
    }
}
