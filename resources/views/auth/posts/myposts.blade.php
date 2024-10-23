<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My posts') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5 p-4">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.828l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934z" />
                    </svg>
                </span>
            </div>
        @endif
        <p class="mb-3"><a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Back to Dashboard</a></p>
        @if ($posts->isEmpty())
            <p class="mt-4">You have not created any posts yet.</p>
        @else
            @foreach ($posts as $post)
                <div class="bg-white shadow-md rounded-lg mb-4 p-6">
                    <h2 class="text-2xl font-bold mb-2">
                        <a href="{{ route('posts.show', $post->id) }}"
                            class="text-blue-500 hover:underline">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-700 mb-4">{{ $post->content }}</p>
                    <p class="text-gray-500 text-sm mb-4">
                        By {{ $post->user->name }},
                        <span>{{ $post->created_at->format('F j, Y, H:i') }}</span>
                    </p>
                    <div>
                        @foreach ($post->categories as $category)
                            <span
                                class="inline-block bg-blue-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
