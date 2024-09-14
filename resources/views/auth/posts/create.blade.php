<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a New Post') }}
        </h2>
    </x-slot>
    <div class="container max-w-screen-lg mx-auto mt-5">
        <p class="mb-3"><a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Back to Dashboard</a></p>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" id="post-form">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                <textarea id="content" name="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="5">{{ old('content') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="categories" class="block text-gray-700 text-sm font-bold mb-2">Categories:</label>
                <div id="category-checkboxes" class="flex flex-wrap gap-2">
                    @foreach($categories as $category)
                        @if($category->name !== 'Unsorted')
                            <div class="flex items-center">
                                <input type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" class="mr-2">
                                <label for="category-{{ $category->id }}" class="text-gray-700">{{ $category->name }}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Post</button>
        </form>
    </div>
</x-app-layout>
