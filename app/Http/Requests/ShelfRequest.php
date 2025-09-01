<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShelfRequest extends FormRequest
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
            'shelf_name' => 'required|string|max:100',
            'shelf_position' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'shelf_name.required' => 'Shelf name is required.',
            'shelf_name.string' => 'Shelf name must be a string.',
            'shelf_name.max' => 'Shelf name must not exceed 100 characters.',
            'shelf_position.string' => 'Shelf position must be a string.',
            'shelf_position.max' => 'Shelf position must not exceed 255 characters.',
        ];
    }
}
