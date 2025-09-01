<x-admin.layout>
    <x-slot name="title">Tambah Peminjaman</x-slot>
    
    <div class="flex flex-col gap-1 lg:gap-2">
        <h1 class="font-semibold md:text-lg">Tambah Peminjaman</h1>
        <div class="flex items-center gap-1">
            <p class="text-xs text-gray-400 md:text-sm">Admin</p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm"><a href="{{ route('admin.borrowing.index') }}" class="text-blue-500 hover:underline">Peminjaman</a></p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm">Tambah</p>
        </div>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <span class="block sm:inline">Ada kesalahan dalam input data Anda.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
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
            <h2 class="text-lg font-semibold mb-4">Formulir Peminjaman Baru</h2>
            <form action="{{ route('admin.borrowing.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="borrowing_user_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Peminjam:</label>
                    <select name="borrowing_user_id" id="borrowing_user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('borrowing_user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="borrowing_borrowed_at" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Peminjaman:</label>
                    <input type="date" name="borrowing_borrowed_at" id="borrowing_borrowed_at" value="{{ old('borrowing_borrowed_at', now()->toDateString()) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="borrowing_notes" class="block text-gray-700 text-sm font-bold mb-2">Catatan:</label>
                    <textarea name="borrowing_notes" id="borrowing_notes" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('borrowing_notes') }}</textarea>
                </div>

                <div id="book-items-container" class="space-y-4">
                    @forelse (old('books', [0]) as $index => $oldBookItem)
                        @include('page.admin.borrowing.book_item', ['books' => $books, 'index' => $index, 'oldBookItem' => $oldBookItem])
                    @empty
                        @include('page.admin.borrowing.book_item', ['books' => $books, 'index' => 0])
                    @endforelse
                </div>
                
                <div class="mt-4 flex justify-end">
                    <button type="button" id="add-book-item-btn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm focus:outline-none focus:shadow-outline">
                        Tambah Buku Lain
                    </button>
                </div>

                <div class="mt-6 flex justify-between">
                    <a href="{{ route('admin.borrowing.index') }}" 
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Kembali
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                setTimeout(() => {
                    message.style.display = 'none';
                }, 5000); 
            });
            
            let bookItemIndex = document.querySelectorAll('.book-item-card').length;
            const addBookItemBtn = document.getElementById('add-book-item-btn');
            const bookItemsContainer = document.getElementById('book-items-container');

            addBookItemBtn.addEventListener('click', function() {
                const url = `{{ route('admin.borrowing.getBookItemForm') }}?index=${bookItemIndex}`;
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const newDiv = document.createElement('div');
                        newDiv.innerHTML = html;
                        bookItemsContainer.appendChild(newDiv.firstElementChild);
                        bookItemIndex++;
                        updateRemoveButtons();
                    });
            });

            function updateRemoveButtons() {
                const removeBtns = document.querySelectorAll('.remove-book-item-btn');
                const bookItems = document.querySelectorAll('.book-item-card');
                const isOnlyOne = bookItems.length <= 1;
                
                removeBtns.forEach(btn => {
                    btn.style.display = isOnlyOne ? 'none' : 'block';
                    btn.onclick = function() {
                        if (!isOnlyOne) {
                            btn.closest('.book-item-card').remove();
                            updateRemoveButtons();
                        }
                    };
                });
            }
            updateRemoveButtons();
        });
    </script>
</x-admin.layout>
