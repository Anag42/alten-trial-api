<?php

namespace App\Http\Requests;

use App\Enums\InventoryStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['string', 'max:255', Rule::unique('products')->ignore($this->route('product'))],
            'name' => ['string', 'max:255', Rule::unique('products')->ignore($this->route('product'))],
            'description' => 'string|unique:table,column,except,id',
            'image' => 'image',
            'category' => 'max:255|string',
            'price' => 'decimal:2',
            'quantity' => 'integer',
            'internalReference' => 'max:255|string',
            'shellId' => 'integer',
            'inventoryStatus' => [new Enum(InventoryStatus::class)],
            'rating' => 'integer',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Throw an HttpResponseException with a JSON response for API usage
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors() // This will contain the validation error messages
        ], 422));
    }
}
