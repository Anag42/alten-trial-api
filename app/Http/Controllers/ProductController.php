<?php

namespace App\Http\Controllers;

use App\Enums\InventoryStatus;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Response;
class ProductController extends Controller
{
    /**
     * Retrieve all products
     * @return AnonymousResourceCollection
     */
    public function findAll(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Create a new product
     * @param StoreProductRequest $request
     *
     * @return ProductResource
     */
    public function create(StoreProductRequest $request): ProductResource
    {
        $validatedData = $request->all();

        $filePath = $request->file('image')->storePublicly('products', 'public');

        $validatedData['image'] = $filePath;

        $product = Product::create($validatedData);

        return new ProductResource($product);
    }

    /**
     * Retrieve details for a specific product
     * @param Product $product
     *
     * @return ProductResource
     */
    public function findOne(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update details of a specific product
     * @param StoreProductRequest $request
     * @param Product $product
     *
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $validatedData = $request->all();

        // Upload the image with the same existing name to prevent unnecessary files
        if ($request->hasFile('image')) {
            $fileName = explode('/', $product->image)[1];

            $filePath = $request->file('image')->storeAs('products', $fileName, 'public');

            $validatedData['image'] = $filePath;
        }

        $updatedProduct = $product->fill($validatedData);

        $updatedProduct->save();

        return new ProductResource($updatedProduct);
    }

    /**
     * Delete a product
     * @param Product $product
     *
     * @return ProductResource
     */
    public function delete(Product $product): ProductResource
    {
        $product->delete();

        return new ProductResource($product);
    }
}
