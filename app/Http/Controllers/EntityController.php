<?php
// EntityController.php
namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\SizeResource;
use App\Models\Brand;
use App\Models\ProductManager\ProductCategory;
use App\Models\Color;
use App\Models\Size;

class EntityController extends Controller
{
    public function getEntities()
    {
        $brands = BrandResource::collection(Brand::all());
        $categories = ProductCategoryResource::collection(ProductCategory::all());
        $colors = ColorResource::collection(Color::all());
        $sizes = SizeResource::collection(Size::all());

        return [
            'brands' => $brands,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
        ];
    }
}
