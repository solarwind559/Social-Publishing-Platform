<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container max-w-screen-lg mx-auto mt-5 p-4">
        <div class="container">
            <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
            <p class="mt-2 text-gray-700">{{ $user->profile->bio ?? '' }}</p>
        </div>

        <div class="container mt-6">
            <h2 class="text-2xl font-bold mb-4">Posted by {{ $user->name }}</h2>
            @if ($user->posts->isEmpty())
                <p class="mt-4 text-gray-700">No posts yet</p>
            @else
                <div class="posts">
                    @foreach ($posts as $post)
                        <div class="bg-white shadow-md rounded-lg mb-4 p-6">
                            <h2 class="text-2xl font-bold mb-2">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-700 mb-4">{{ Str::limit($post->content, 100) }}</p>
                            <p class="text-gray-500 text-sm mb-4">
                                <span>{{ $post->created_at->format('F j, Y, H:i') }}</span>
                            </p>
                            <div>
                                @foreach ($post->categories as $category)
                                    <span class="inline-block bg-blue-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>


</x-app-layout>
