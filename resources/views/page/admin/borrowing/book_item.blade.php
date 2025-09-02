<div class="book-item-card bg-gray-50 p-4 rounded-lg shadow-sm mb-3 border border-gray-200">
    <div class="flex justify-end">
        <button type="button" class="remove-book-item text-red-500 hover:text-red-700 text-sm font-semibold">
            Remove
        </button>
    </div>
    <div class="mb-3">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="books_{{ $index }}_book_id">Book</label>
        <select name="books[{{ $index }}][book_id]" id="books_{{ $index }}_book_id"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('books.' . $index . '.book_id') border-red-500 @enderror" required>
            <option value="">Select Book</option>
            @foreach($books as $book)
                <option value="{{ $book->book_id }}" {{ old('books.' . $index . '.book_id') == $book->book_id ? 'selected' : '' }}>
                    {{ $book->book_name }} (Stock: {{ $book->book_stock }})
                </option>
            @endforeach
        </select>
        @error('books.' . $index . '.book_id')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="books_{{ $index }}_quantity">Quantity</label>
        <input type="number" name="books[{{ $index }}][quantity]" id="books_{{ $index }}_quantity"
               placeholder="Quantity" min="1"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('books.' . $index . '.quantity') border-red-500 @enderror"
               value="{{ old('books.' . $index . '.quantity', 1) }}" required>
        @error('books.' . $index . '.quantity')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
