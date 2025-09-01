<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BorrowingRequest extends FormRequest
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
        $rules = [
            'borrowing_user_id' => [
                'required',
                'uuid',
                Rule::exists('users', 'id'), // Pastikan user_id ada di tabel users
            ],
            'borrowing_borrowed_at' => 'required|date',
            'borrowing_notes' => 'nullable|string|max:500',
            'borrowing_fine' => 'nullable|integer|min:0',
            'borrowing_returned' => 'required|boolean',
            'returned_at' => 'nullable|date|after_or_equal:borrowing_borrowed_at',
        ];

        if ($this->has('books') && is_array($this->input('books'))) {
            foreach ($this->input('books') as $index => $book) {
                $rules["books.{$index}.book_id"] = [
                    'required',
                    'uuid',
                    Rule::exists('books', 'book_id'), // Pastikan book_id ada di tabel books
                ];
                $rules["books.{$index}.quantity"] = 'required|integer|min:1';
            }
        } else {
            $rules['books'] = 'required|array|min:1';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'borrowing_user_id.required' => 'User ID is required.',
            'borrowing_user_id.exists' => 'The selected user does not exist.',
            'borrowing_book_id.required' => 'Book ID is required.',
            'borrowing_book_id.exists' => 'The selected book does not exist.',
            'borrowing_borrowed_at.required' => 'Borrowed date is required.',
            'borrowing_borrowed_at.date' => 'Borrowed date must be a valid date.',
            'returned_at.date' => 'Returned date must be a valid date.',
            'returned_at.after_or_equal' => 'Returned date must be after or equal to the borrowed date.',
            'borrowing_notes.string' => 'Notes must be a string.',
            'borrowing_notes.max' => 'Notes must not exceed 255 characters.',
            'borrowing_fine.integer' => 'Fine must be an integer.',
            'borrowing_fine.min' => 'Fine must be at least 0.',
            'borrowing_returned.required' => 'Returned status is required.',
            'borrowing_returned.boolean' => 'Returned status must be true or false.',
        ];

        if ($this->has('books') && is_array($this->input('books'))) {
            foreach ($this->input('books') as $index => $book) {
                $messages["books.{$index}.book_id.required"] = 'Book ID is required.';
                $messages["books.{$index}.book_id.exists"] = 'The selected book does not exist.';
                $messages["books.{$index}.quantity.required"] = 'Quantity is required.';
                $messages["books.{$index}.quantity.integer"] = 'Quantity must be an integer.';
                $messages["books.{$index}.quantity.min"] = 'Quantity must be at least 1.';
            }
        } else {
            $messages['books.required'] = 'At least one book must be selected.';
            $messages['books.array'] = 'Books must be an array.';
            $messages['books.min'] = 'At least one book must be selected.';
        }
    }


}
