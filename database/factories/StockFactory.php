<?php

namespace Database\Factories;
use App\Models\product_management\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
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
    return $this->afterCreating(function (Stock $stock) {
        // Generate all possible combinations of product, color, and size
        $products = Product::pluck('id');
        $colors = Color::pluck('id');
        $sizes = Size::pluck('id');

        foreach ($products as $productId) {
            foreach ($colors as $colorId) {
                foreach ($sizes as $sizeId) {
                    // Skip if a stock entry for this combination already exists
                    if (
                        Stock::where('product_id', $productId)
                            ->where('color_id', $colorId)
                            ->where('size_id', $sizeId)
                            ->exists()
                    ) {
                        continue;
                    }

                    // Create a stock entry for each combination
                    Stock::factory()->create([
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