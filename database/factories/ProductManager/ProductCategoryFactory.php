<?php

namespace Database\Factories\ProductManager;

use App\Models\ProductManager\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories=array('Men','Women','Children','Unisex');
        return [
            'name'=>$this->faker->unique()->randomElement($categories),
            'description'=>$this->faker->sentence
        ];
    }
}
