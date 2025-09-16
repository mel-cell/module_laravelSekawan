<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileImageRequest extends FormRequest
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
            'profileimg' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'profileimg.required' => 'Please select a profile image to upload.',
            'profileimg.image' => 'The uploaded file must be a valid image.',
            'profileimg.mimes' => 'Profile image must be a file of type: jpeg, png, jpg, gif, webp.',
            'profileimg.max' => 'Profile image size must not exceed 2MB.',
            'profileimg.dimensions' => 'Profile image dimensions must be between 100x100 and 2000x2000 pixels.',
        ];
    }
}
