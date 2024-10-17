<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "name" => $this->name,
            "description" => $this->description,
            "image" => env("APP_URL") . '/storage/' . $this->image,
            "category" => $this->category,
            "price" => number_format($this->price, 2), // This is used to keep the price persistant, a float format with a percision of 2 (ex: 100.00)
            "quantity" => $this->quantity,
            "internalReference" => $this->internalReference,
            "shellId" => $this->shellId,
            "inventoryStatus" => $this->inventoryStatus,
            "rating" => $this->rating,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}
