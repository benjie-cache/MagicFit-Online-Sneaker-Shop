<?php

namespace Database\Factories\ProductManager;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $colorName = $this->faker->colorName;
        
        return [
            'name' => $colorName,
            'color_code' => $this->generateColorCode($colorName),
        ];
    }

    /**
     * Generate a color code based on the ASCII values of the characters in the name.
     *
     * @param string $name
     * @return string
     */
    private function generateColorCode($name)
    {
        $asciiSum = array_sum(array_map('ord', str_split($name)));
        return '#' . substr(md5($asciiSum), 0, 6); // Use the first 6 characters of the MD5 hash
    }
}
