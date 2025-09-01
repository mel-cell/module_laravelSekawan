<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
            'book_name' => 'required|string|max:255',
            'book_isbn' => 'required|string|max:13|unique:books,book_isbn,' . $this->route('id') . ',book_id',
            'book_stock' => 'required|integer|min:0',
            'book_description' => 'nullable|string',
            'book_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book_category_id' => 'required|exists:categories,category_id',
            'book_publisher_id' => 'required|exists:publishers,publisher_id',
            'book_author_id' => 'required|exists:authors,author_id',
            'book_shelf_id' => 'required|exists:shelves,shelf_id',

            // validasi untuk fk
            'author_id' => [
                'required',
                'exists:authors,author_id',
                Rule::exists('author', 'author_id'),
            ],

            'category_id' => [
                'required',
                'exists:categories,category_id',
                Rule::exists('category', 'category_id'),
            ],

            'publisher_id' => [
                'required',
                'exists:publishers,publisher_id',
                Rule::exists('publisher', 'publisher_id'),
            ],

            'shelf_id' => [
                'required',
                'exists:shelves,shelf_id',
                Rule::exists('shelf', 'shelf_id'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'book_name.required' => 'Nama buku wajib diisi.',
            'book_name.string' => 'Nama buku harus berupa teks.',
            'book_name.max' => 'Nama buku maksimal 255 karakter.',
            'book_isbn.required' => 'ISBN wajib diisi.',
            'book_isbn.string' => 'ISBN harus berupa teks.',
            'book_isbn.max' => 'ISBN maksimal 13 karakter.',
            'book_isbn.unique' => 'ISBN sudah digunakan oleh buku lain.',
            'book_stock.required' => 'Stok buku wajib diisi.',
            'book_stock.integer' => 'Stok buku harus berupa angka.',
            'book_stock.min' => 'Stok buku tidak boleh kurang dari 0.',
            'book_description.string' => 'Deskripsi buku harus berupa teks.',
            'book_img.image' => 'Gambar harus berupa file gambar.',
            'book_img.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'book_img.max' => 'Gambar maksimal berukuran 2MB.',
            'book_category_id.required' => 'Kategori wajib dipilih.',
            'book_category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'book_publisher_id.required' => 'Penerbit wajib dipilih.',
            'book_publisher_id.exists' => 'Penerbit yang dipilih tidak valid.',
            'book_author_id.required' => 'Pengarang wajib dipilih.',
            'book_author_id.exists' => 'Pengarang yang dipilih tidak valid.',
            'book_shelf_id.required' => 'Rak wajib dipilih.',
            'book_shelf_id.exists' => 'Rak yang dipilih tidak valid.',

            // custom message untuk fk
            'author_id.required' => 'Pengarang wajib dipilih.',
            'author_id.exists' => 'Pengarang yang dipilih tidak valid.',

            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'publisher_id.required' => 'Penerbit wajib dipilih.',
            'publisher_id.exists' => 'Penerbit yang dipilih tidak valid.',

            'shelf_id.required' => 'Rak wajib dipilih.',
            'shelf_id.exists' => 'Rak yang dipilih tidak valid.',
        ];
    }
}
