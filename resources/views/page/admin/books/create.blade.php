<x-admin.layout>
    <x-slot name="title">Create New Book</x-slot>
    
    <div class="flex flex-col gap-1 lg:gap-2">
        <h1 class="font-semibold md:text-lg">Create New Book</h1>
        <div class="flex items-center gap-1">
            <p class="text-xs text-gray-400 md:text-sm">Admin</p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm"><a href="{{ route('admin.books') }}" class="text-blue-500 hover:underline">Book</a></p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm">Create</p>
        </div>
        
        @if (session('success'))
            <div class="flash-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div class="flash-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6 my-4">
            <h2 class="text-lg font-semibold mb-4">Book Details</h2>
            <form action="{{ route('admin.books.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_name">Title</label>
                    <input type="text" name="book_name" id="book_name" placeholder="Book Title" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_name') border-red-500 @enderror"
                           value="{{ old('book_name') }}" required>
                    @error('book_name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_isbn">ISBN</label>
                    <input type="text" name="book_isbn" id="book_isbn" placeholder="Book ISBN (e.g., 978-3-16-148410-0)" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_isbn') border-red-500 @enderror"
                           value="{{ old('book_isbn') }}">
                    @error('book_isbn')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_stock">Stock</label>
                    <input type="number" name="book_stock" id="book_stock" placeholder="Book Stock" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_stock') border-red-500 @enderror"
                           value="{{ old('book_stock') }}">
                    @error('book_stock')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_description">Description</label>
                    <textarea name="book_description" id="book_description" placeholder="Book Description" rows="3"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_description') border-red-500 @enderror"
                              required>{{ old('book_description') }}</textarea>
                    @error('book_description')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_img">Image URL (String)</label>
                    <input type="text" name="book_img" id="book_img" placeholder="e.g. https://placehold.co/150x200" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_img') border-red-500 @enderror"
                           value="{{ old('book_img') }}">
                    @error('book_img')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dropdown untuk Category --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_category_id">Category</label>
                    <select name="book_category_id" id="book_category_id" 
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_category_id') border-red-500 @enderror" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('book_category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_category_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dropdown untuk Publisher --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_publisher_id">Publisher</label>
                    <select name="book_publisher_id" id="book_publisher_id" 
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_publisher_id') border-red-500 @enderror" required>
                        <option value="">Select Publisher</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->publisher_id }}" {{ old('book_publisher_id') == $publisher->publisher_id ? 'selected' : '' }}>
                                {{ $publisher->publisher_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_publisher_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dropdown untuk Author --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_author_id">Author</label>
                    <select name="book_author_id" id="book_author_id" 
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_author_id') border-red-500 @enderror" required>
                        <option value="">Select Author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->author_id }}" {{ old('book_author_id') == $author->author_id ? 'selected' : '' }}>
                                {{ $author->author_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_author_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dropdown untuk Shelf --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="book_shelf_id">Shelf</label>
                    <select name="book_shelf_id" id="book_shelf_id" 
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_shelf_id') border-red-500 @enderror" required>
                        <option value="">Select Shelf</option>
                        @foreach($shelves as $shelf)
                            <option value="{{ $shelf->shelf_id }}" {{ old('book_shelf_id') == $shelf->shelf_id ? 'selected' : '' }}>
                                {{ $shelf->shelf_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_shelf_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between mt-6">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create Book
                    </button>
                    <a href="{{ route('admin.books') }}" 
                       class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
