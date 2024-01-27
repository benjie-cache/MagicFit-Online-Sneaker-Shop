<?php
namespace Database\Factories\ProductManager;


use App\Models\ProductManager\Product;
use App\Models\ProductManager\ProductImage;
use App\Models\ProductColor;
use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        // Get the path to the images folder
        $imagesPath = storage_path('app/public/images');

        // Get all subdirectories (each subdirectory represents a product)
        $subdirectories = array_filter(glob($imagesPath . '/*'), 'is_dir');

        foreach ($subdirectories as $subdirectory) {
            // Get the product name from the subdirectory name
            $productName = basename($subdirectory);

            // Generate the product name and slug
            $productNameSlug = Str::slug($productName);

            // Check if the product already exists, if not, create it
            $product = Product::firstOrCreate(
                ['name' => $productNameSlug],
                [
                    'products_category_id' => $this->faker->numberBetween(1, 3),
                    'brand_id' => $this->faker->numberBetween(1, 5),
                    'slug' => $productNameSlug,
                    'description' => $this->faker->paragraph,
                    'sku' => 'SKU_' . uniqid(),
                ]
            );

            // Get all subdirectories in the product directory (each represents a color)
            $colorSubdirectories = array_filter(glob($subdirectory . '/*'), 'is_dir');

            foreach ($colorSubdirectories as $colorSubdirectory) {
                // Get the color name from the subdirectory name
                $colorName = basename($colorSubdirectory);

                // Use ColorFactory to create color and get its ID
                $color = Color::firstOrCreate(
                    ['name' => $colorName],
                    ['color_code' => $this->faker->hexcolor]
                );

                // Create product color entry
                $productColor = ProductColor::firstOrCreate(
                    ['product_id' => $product->id, 'color_id' => $color->id],
                    ['price' => rand(400, 500) * 10]
                );

                // Generate product images for each view (top, side, rear)
                $views = ['top', 'side', 'rear'];
                foreach ($views as $view) {
                    $viewFiles = glob($colorSubdirectory . '/' . $view . '.*');
                    foreach ($viewFiles as $file) {
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                        $imageUrl = "/images/{$productNameSlug}/{$colorName}/{$view}.{$extension}";

                        ProductImage::create([
                            'product_color_id' => $productColor->id,
                            'image_path' => $imageUrl,
                           
                            'view' => $view,
                        ]);
                    }
                }
            }
        }
    }
}