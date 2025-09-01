<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'author_name' => 'required|string|max:150',
            'author_description' => 'required|string|max:255',
        ];
    }

    // Opsional: Pesan error kustom
    public function messages(): array
    {
        return [
            'author_name.required' => 'Name field is required',
            'author_name.max' => 'Maximum character for Name field is 150',
            'author_name.string' => 'Description field must be a string',
            'author_description.string' => 'Description field must be a string',
            'author_description.max' => 'Maximum character for Name field is 150'
        ];
    }
}
