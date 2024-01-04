<?php


namespace Database\Factories\product_management;

use App\Models\product_management\Product;
use App\Models\product_management\ProductImage;
use App\Models\product_management\ProductDiscount;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $productName = $this->faker->unique()->word;
        $productSlug = Str::slug($productName);

        return [
            'name' => $productName,
            'slug' => $productSlug,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'is_hot_deal_of_the_day' => $this->faker->boolean(10), // 10% chance of being a hot deal
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // Attach product images
            $this->attachProductImages($product);

            // Conditionally attach product discount
            if ($product->is_hot_deal_of_the_day) {
                $this->attachProductDiscount($product);
            }
        });
    }

    private function attachProductImages(Product $product)
    {
        $views = ['front', 'side', 'top']; // Add more views if needed

        foreach ($views as $view) {
            $color = $this->faker->colorName;
            $imageUrl = "public/assets/images/{$product->slug}/{$view}.jpg";

            ProductImage::factory()->create([
                'product_id' => $product->id,
                'url' => $imageUrl,
                'color' => $color,
                'view' => $view,
            ]);
        }
    }

    private function attachProductDiscount(Product $product)
    {
        $discountPercentage = $this->faker->numberBetween(5, 50);
        $startDate = now()->toDateString();
        $endDate = now()->addDays($this->faker->numberBetween(1, 30))->toDateString();

        ProductDiscount::factory()->create([
            'product_id' => $product->id,
            'discount_percentage' => $discountPercentage,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}
