<?php

namespace Database\Factories\ProductManager;

use App\Models\ProductManager\ProductDiscount;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDiscountFactory extends Factory
{
    protected $model = ProductDiscount::class;

    public function definition()
    {
        return [
            'product_id' => function () {
                return \App\Models\ProductManager\Product::factory()->create()->id;
            },
            'discount_percentage' => $this->faker->numberBetween(5, 50),
            'discount_amount' => $this->faker->randomFloat(2, 5, 100),
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays($this->faker->numberBetween(1, 30))->toDateString(),
        ];
    }
}