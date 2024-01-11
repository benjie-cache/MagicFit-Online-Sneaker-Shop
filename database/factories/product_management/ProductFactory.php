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
               // Generate the product name and slug
            $productNameSlug = Str::slug($productName);
    
            // Print the current subdirectory
            echo "Processing directory: $productName\n";
            $product = Product::create([
                'products_category_id'=>$this->faker->numberBetween(1, 3),
                'brand_id'=>$this->faker->numberBetween(1, 5),
                'name' => $productNameSlug,
                'slug' => $productNameSlug,
                'description' => $this->faker->paragraph,
                'price' => $this->faker->randomFloat(2, 4000, 10000),
                'is_hot_deal_of_the_day' => $this->faker->boolean(30),
            ]);
             // Get all files in the subdirectory
             $files = glob($subdirectory . '/*');

             // Attach product images
             $views = ['top', 'side', 'rear'];
             foreach ($views as $view) {
                 // Filter files based on the current view
                 $filteredFiles = preg_grep("/{$view}\.(jpg|png|gif|jpeg|webp)/i", $files);
 
                 foreach ($filteredFiles as $file) {
                     $fileName = pathinfo($file, PATHINFO_FILENAME);
                     $extension = pathinfo($file, PATHINFO_EXTENSION);
 
                     $color = $this->faker->colorName;
                     $imageUrl = "/images/{$productNameSlug}/{$view}.{$extension}";
 
                     ProductImage::factory()->create([
                         'product_id' => $product->id,
                         'url' => $imageUrl,
                         'color' => $color,
                         'view' => $view,
                     ]);
                 }
             }
 
             
                // Create a new product instance for each iteration
               
    
               
    
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
    
               
            }
        }
      
    }
    

   

