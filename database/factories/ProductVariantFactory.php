<?php

namespace Database\Factories;
use App\Models\ProductManager\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductVariant;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class StockFactory extends Factory
{
    public function definition()
    {
        $productId = Product::inRandomOrder()->first()->id;
        $colorId = Color::inRandomOrder()->first()->id;
        $sizeId = Size::inRandomOrder()->first()->id;

        return [
            'product_id' => $productId,
            'color_id' => $colorId,
            'size_id' => $sizeId,
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }

    public function configure()
{
    return $this->afterCreating(function (ProductVariant $productvariant) {
        // Generate all possible combinations of product, color, and size
        $products = Product::pluck('id');
        $colors = Color::pluck('id');
        $sizes = Size::pluck('id');

        foreach ($products as $productId) {
            foreach ($colors as $colorId) {
                foreach ($sizes as $sizeId) {
                    // Skip if a productvariant entry for this combination already exists
                    if (
                        ProductVariant::where('product_id', $productId)
                            ->where('color_id', $colorId)
                            ->where('size_id', $sizeId)
                            ->exists()
                    ) {
                        continue;
                    }

                    // Create a productvariant entry for each combination
                    ProductVariant::factory()->create([
                        'product_id' => $productId,
                        'color_id' => $colorId,
                        'size_id' => $sizeId,
                    ]);
                }
            }
        }
    });
}
}