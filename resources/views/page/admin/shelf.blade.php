<x-admin.layout>
    <x-slot name="title">Shelf Management</x-slot>
    
    <div class="flex flex-col gap-1 lg:gap-2">
        <h1 class="font-semibold md:text-lg">Shelf Management</h1>
        <div class="flex items-center gap-1">
            <p class="text-xs text-gray-400 md:text-sm">Admin</p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm">Shelf</p>
        </div>
        
        {{-- Flash Messages (Success/Error) --}}
        <div class="flash-message-container">
            @if (session('success'))
                <div class="flash-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @elseif (session('error'))
                <div class="flash-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-y-4 my-4 lg:grid-cols-2 lg:gap-x-8">
            <!-- Create Form -->
            <div class="bg-white shadow-md rounded-lg p-6 lg:order-2">
                <h2 class="text-lg font-semibold mb-4">Create Shelf</h2>
                <form action="{{ route('admin.shelf.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="create_shelf_name">Name</label>
                        <input type="text" name="shelf_name" id="create_shelf_name" placeholder="Shelf Name" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('shelf_name') border-red-500 @enderror"
                               value="{{ old('shelf_name') }}" required>
                        @error('shelf_name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="create_shelf_position">Position</label>
                        <textarea name="shelf_position" id="create_shelf_position" placeholder="Shelf Position" rows="3"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('shelf_position') border-red-500 @enderror"
                                  required>{{ old('shelf_position') }}</textarea>
                        @error('shelf_position')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create Shelf
                    </button>
                </form>
            </div>

            <!-- Shelves Table -->
            <div class="bg-white shadow-md rounded-lg p-6 lg:order-1">
                @livewire('admin.shifts.table')
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full flex items-center justify-center z-50">
        <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Shelf</h3>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_name">Name</label>
                        <input type="text" id="edit_name" name="shelf_name" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_location">Location</label>
                        <textarea id="edit_location" name="shelf_location" rows="3"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="closeEditModal()"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </button>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full flex items-center justify-center z-50">
        <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Deletion</h3>
                <p class="text-gray-700 mb-6">Are you sure you want to delete this shelf? This action cannot be undone.</p>
                <div class="flex justify-center space-x-4">
                    <button type="button" onclick="closeDeleteConfirmModal()"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
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
        });

        function editShelf(id, name, location) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_location').value = location;
            document.getElementById('editForm').action = `/admin/shelf/${id}`; 
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function confirmDelete(id) {
            document.getElementById('deleteForm').action = `/admin/shelf/${id}`; 
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteConfirmModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }
    </script>
</x-admin.layout>

