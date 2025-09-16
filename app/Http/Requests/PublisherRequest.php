<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
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
            'publisher_name' => 'required|string|max:255',
            'publisher_deskription' => 'nullable|string|max:1000',
            
        ];
    }

    public function messages(): array
    {
        return [
            'publisher_name.required' => 'Nama penerbit harus diisi.',
            'publisher_name.string' => 'Nama penerbit harus berupa teks.',
            'publisher_name.max' => 'Nama penerbit tidak boleh lebih dari 255 karakter.',
            'publisher_deskription.string' => 'Deskripsi penerbit harus berupa teks.',
            'publisher_deskription.max' => 'Deskripsi penerbit tidak boleh lebih dari 1000 karakter.',
        ];
    }
}
