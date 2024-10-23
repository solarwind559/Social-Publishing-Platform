<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My posts') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Edit Post</h1>
            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title" class="border rounded w-full py-2 px-3 text-gray-700" value="{{ old('title', $post->title) }}" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
                    <textarea name="content" id="content" class="border rounded w-full py-2 px-3 text-gray-700" required>{{ old('content', $post->content) }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="categories" class="block text-gray-700 text-sm font-bold mb-2">Categories:</label>
                    <div id="category-checkboxes" class="flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            @if($category->name !== 'Unsorted')
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        @if($post->categories->contains($category->id)) checked @endif>
                                    <span class="ml-2">{{ $category->name }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Post</button>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectedCategoriesInput = document.getElementById('selected-categories');
            const categoryButtons = document.querySelectorAll('.category-button');

            categoryButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const categoryId = this.getAttribute('data-category-id');
                    let selectedCategories = selectedCategoriesInput.value ? selectedCategoriesInput.value.split(',') : [];

                    if (selectedCategories.includes(categoryId)) {
                        selectedCategories = selectedCategories.filter(id => id !== categoryId);
                        this.classList.remove('bg-blue-500', 'text-white');
                        this.classList.add('bg-gray-200', 'text-gray-700');
                    } else {
                        selectedCategories.push(categoryId);
                        this.classList.remove('bg-gray-200', 'text-gray-700');
                        this.classList.add('bg-blue-500', 'text-white');
                    }

                    selectedCategoriesInput.value = selectedCategories.join(',');
                });

                // Initialize button state based on pre-selected categories
                const preSelectedCategories = selectedCategoriesInput.value.split(',');
                if (preSelectedCategories.includes(button.getAttribute('data-category-id'))) {
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                    button.classList.add('bg-blue-500', 'text-white');
                }
            });
        });
    </script>
</x-app-layout>
