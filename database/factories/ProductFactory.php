<?php

namespace Database\Factories;

use App\Enums\InventoryStatus;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('PROD-####'),
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->paragraph,
            'image' => 'products/' . $this->faker->image('storage/app/public/products', 640, 480, null, false),
            'category' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'internalReference' => $this->faker->unique()->bothify('REF-####'),
            'shellId' => $this->faker->numberBetween(1, 10),
            'inventoryStatus' => $this->faker->randomElement(array_column(InventoryStatus::cases(), 'value')),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
