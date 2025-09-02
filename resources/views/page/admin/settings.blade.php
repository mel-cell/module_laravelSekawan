@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <div class="flex flex-col gap-1 lg:gap-2">
        <h1 class="font-semibold md:text-lg">Settings</h1>
        <div class="flex items-center gap-1">
            <p class="text-xs text-gray-400 md:text-sm">Admin</p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm">Settings</p>
        </div>
        @if (session('success'))
            <div role="alert" class="alert alert-success bg-green-600 bg-opacity-25 mt-4">
                <i class="fas fa-info-circle text-green-600"></i>
                <span class="text-green-600 font-medium text-sm">{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div role="alert" class="alert alert-success bg-red-600 bg-opacity-25 mt-4">
                <i class="fas fa-info-circle text-red-600"></i>
                <span class="text-red-600 font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif
        <div class="grid grid-cols-1 gap-y-4 my-4 lg:grid-cols-2 lg:gap-x-8">
            <div class="card w-full bg-white shadow rounded-md h-fit lg:order-2">
                <div class="px-4 py-4">
                    <h2 class="font-medium text-sm md:text-base">Personal Information</h2>
                    <div class="divider mt-1 mb-2"></div>
                    <div class="grid grid-cols-2 gap-y-4">
                        <div class="flex flex-col gap-1">
                            <p class="font-medium text-sm">First Name</p>
                            <p class="text-sm text-gray-400">{{ $user->first_name }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="font-medium text-sm">Last Name</p>
                            <p class="text-sm text-gray-400">{{ $user->last_name }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="font-medium text-sm">Username</p>
                            <p class="text-sm text-gray-400">{{ $user->username }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="font-medium text-sm">Email</p>
                            <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card w-full bg-white shadow rounded-md h-fit lg:order-2">
                <div class="px-4 py-4">
                    <h2 class="font-medium text-sm md:text-base">Personal Profile</h2>
                    <div class="divider mt-1 mb-2"></div>
                    <div class="flex flex-col items-center gap-4">
                        <div class="avatar">
                            <div class="w-40 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img id="profileImagePreview" src="{{ $user->profile_image_url }}" alt="Profile Image">
                            </div>
                        </div>
                        <form action="{{ route('admin.settings.updateProfileImage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="flex flex-col gap-4 w-full">
                                <div class="flex flex-col gap-y-2">
                                    <label class="text-sm font-medium">Choose new profile image</label>
                                    <input type="file" name="profileimg" id="profileImageInput"
                                        class="file-input file-input-bordered file-input-sm w-full bg-transparent"
                                        accept="image/*" onchange="previewImage(event)" />
                                    @error('profileimg')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                class="px-3 py-2 bg-gray-800 rounded text-sm text-white font-medium block w-full transition-all duration-300 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn">
                                    Update Profile Image
                                </button>
                            </div>
                        </form>
                    </div>

                    <script>
                        function previewImage(event) {
                            const file = event.target.files[0];
                            const preview = document.getElementById('profileImagePreview');
                            const submitBtn = document.getElementById('submitBtn');

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                                submitBtn.disabled = false;
                            } else {
                                preview.src = '{{ $user->profile_image_url }}';
                                submitBtn.disabled = true;
                            }
                        }

                        // Disable submit button initially
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('submitBtn').disabled = true;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection