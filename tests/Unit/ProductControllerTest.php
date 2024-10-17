<?php

namespace Tests\Unit;

use App\Enums\InventoryStatus;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testFindAll()
    {
        Storage::fake('public');

        $products = Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function testCreate()
    {
        Storage::fake('public');

        $productData = [
            'code' => 'PROD-1234',
            'name' => 'Test Product',
            'description' => 'This is a test product description.',
            'image' => UploadedFile::fake()->image('product.jpg'),
            'category' => 'Test Category',
            'price' => 99.99,
            'quantity' => 10,
            'internalReference' => 'INT-5678',
            'shellId' => 1,
            'inventoryStatus' => InventoryStatus::InStock,
            'rating' => 4,
        ];

        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'code' => 'PROD-1234',
                    'name' => 'Test Product',
                    'description' => 'This is a test product description.',
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'code' => 'PROD-1234',
            'name' => 'Test Product',
        ]);
    }

    public function testUpdate()
    {
        Storage::fake('public');

        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Updated Product Name',
            'price' => 199.99,
        ];

        $response = $this->patchJson("/api/products/{$product->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Updated Product Name',
                    'price' => 199.99,
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'price' => 199.99,
        ]);
    }

    public function testDelete()
    {
        Storage::fake('public');

        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
