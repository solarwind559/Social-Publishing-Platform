<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Post') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
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

        <p class="mb-3"><a href="{{ route('dashboard') }}" class="text-blue-500 mt-4 inline-block">Back to
                Dashboard</a>
        </p>
        <div
            class="show-post mb-4 items-center justify-between mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 relative">
            <div class="buttons absolute top-4 right-4 flex space-x-2">
                @auth
                    @can('update', $post)
                        @can('delete', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        @else
                            <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                        @endcan
                    @else
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        @endcan
                    @endcan
                @endauth
            </div>

            <div class="post">
                <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
                <p class="mt-2">{{ $post->content }}</p>
                <small class="block mt-2">By: <a href="{{ route('profile.show', $post->user->id) }}"
                        class="text-blue-500">{{ $post->user->name }}</a></small>
                <small class="block mt-2">Topic:
                    @foreach ($post->categories as $category)
                        <span class="bg-blue-500 text-white px-2 py-1 rounded">{{ $category->name }}</span>
                    @endforeach
                </small>
            </div>
        </div>

        <hr>

        <div class="comments mb-4" id="comments">
            <h2 class="text-xl font-bold mt-6">Comments</h2>
            @if ($post->comments->isEmpty())
                <p class="mt-2">No comments yet</p>
            @else
                @foreach ($post->comments as $comment)
                    <div
                        class="comment flex items-center justify-between mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <div class="comment-content">
                            <small>{{ $comment->created_at->format('F j, Y, H:i') }}</small>
                            <p>
                                <a href="{{ route('profile.show', $comment->user->id) }}"
                                    class="text-blue-500 font-bold">{{ $comment->user->name }}</a>
                                <small> says:</small>
                            </p>
                            <p class="mb-2">{{ $comment->content }}</p>
                        </div>
                        <div class="comment-edit-delete flex items-center space-x-2">
                            @if (Auth::id() == $comment->user_id)
                                <a href="{{ route('comments.edit', $comment->id) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach

            @endif
        </div>

        <hr>

        <div class="add-comment pb-8">
            @auth
                <h2 class="text-xl font-bold mt-6">Join the conversation</h2>
                <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" required class="w-full p-2 border rounded w-1/2 h-32"></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="mt-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Comment</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
</x-app-layout>
