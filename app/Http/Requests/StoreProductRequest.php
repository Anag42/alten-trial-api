<?php

namespace App\Http\Requests;

use App\Enums\InventoryStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class StoreProductRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:products',
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required|string',
            'image' => 'required|image',
            'category' => 'required|max:255|string',
            'price' => 'required|decimal:2',
            'quantity' => 'required|integer',
            'internalReference' => 'required|max:255|string',
            'shellId' => 'required|integer',
            'inventoryStatus' => ['required', new Enum(InventoryStatus::class)],
            'rating' => 'required|integer',
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
