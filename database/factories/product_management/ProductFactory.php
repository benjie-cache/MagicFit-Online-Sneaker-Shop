<?php
namespace Database\Factories\product_management;

use App\Models\product_management\Product;
use App\Models\product_management\ProductImage;
use App\Models\product_management\ProductDiscount;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Exception;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    protected $generatedExtension;

    public function definition()
    {
        // Get the path to the images folder
        $imagesPath = storage_path('app/public/images');
    
        // Get all subdirectories (each subdirectory represents a product)
        $subdirectories = array_filter(glob($imagesPath . '/*'), 'is_dir');
    
        foreach ($subdirectories as $subdirectory) {
            // Get the product name from the subdirectory name
            $productName = basename($subdirectory);
            // Print the current subdirectory
            echo "Processing directory: $productName\n";
            // Get all files in the subdirectory
            $files = glob($subdirectory . '/*');
    
            $sideFile = null;
    
            foreach ($files as $file) {
                $fileName = pathinfo($file, PATHINFO_FILENAME);
    
                if ($fileName === 'side') {
                    $sideFile = $file;
                    break;
                }
            }
    
            if ($sideFile) {
                // If 'side' file is found, determine the extension
                $generatedExtension = pathinfo($sideFile, PATHINFO_EXTENSION);
    
                // Generate the product name and slug
                $productNameSlug = Str::slug($productName);
    
                // Create a new product instance for each iteration
                $product = Product::create([
                    'name' => $productNameSlug,
                    'slug' => $productNameSlug,
                    'description' => $this->faker->paragraph,
                    'price' => $this->faker->randomFloat(2, 4000, 10000),
                    'is_hot_deal_of_the_day' => $this->faker->boolean(30),
                ]);
    
                // Attach product images
                $views = ['front', 'side', 'top']; // Add more views if needed
                foreach ($views as $view) {
                    $color = $this->faker->colorName;
                    $imageUrl = "/images/{$productNameSlug}/{$view}.{$generatedExtension}";
    
                    ProductImage::factory()->create([
                        'product_id' => $product->id,
                        'url' => $imageUrl,
                        'color' => $color,
                        'view' => $view,
                    ]);
                }
    
                // Conditionally attach product discount
                if ($product->is_hot_deal_of_the_day) {
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
    
                // Break the loop after processing the first subdirectory
               // break;
            }
        }
      
    }
    

   
}
