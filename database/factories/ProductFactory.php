<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = storage_path('app/public/sample_image.jpg');
        $imageData = base64_encode(file_get_contents($imagePath));
        return [
            "name"=>fake()->name(),
            "price"=>fake()->randomFloat(2,30,500),
            "description"=>fake()->sentence(),
            'image' => $imageData
        ];
    }
}
