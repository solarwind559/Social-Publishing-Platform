<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <style>
        .control {
            @media (min-width: 768px) {
                flex-direction: row;
                justify-content: space-between;
            }
        }
    </style>

    <div class="px-4 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-3xl font-bold">{{ __('Welcome, ') }}{{ Auth::user()->name }}!</h2>
                    <div class="flex flex-col md:flex-row justify-between items-center mt-4 control">
                        <div class="flex space-x-4 mb-4 md:mb-0">
                            <h1 class="text-2xl font-bold">See All Posts</h1>
                        </div>
                        <div class="flex flex-col md:flex-row">
                            <div class="flex items-center w-full md:w-1/2 p-2">
                                <select id="categoryFilter" class="form-control border rounded px-3 py-2 w-64" onchange="filterByCategory()">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <form action="{{ route('posts.search') }}" method="GET" class="flex items-center w-full md:w-1/2 p-2">
                                <input type="text" name="keyword" placeholder="Search posts..." class="border rounded px-3 py-2">
                                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container mt-6">

                <div class="posts">
                    @if ($posts->isEmpty())
                        <p class="mt-4">No posts found</p>
                    @else
                        @foreach ($posts as $post)
                            <div class="bg-white shadow-md rounded-lg mb-4 p-6">
                                <h2 class="text-2xl font-bold mb-2">
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline">{{ $post->title }}</a>
                                </h2>
                                <p class="text-gray-700 mb-4">{{ Str::limit($post->content, 100) }}</p>
                                <p class="text-gray-500 text-sm mb-4">
                                    By <a href="{{ route('profile.show', $post->user->id) }}" class="text-blue-500 hover:underline">{{ $post->user->name }}</a>,
                                    <span>{{ $post->created_at->format('F j, Y, H:i') }}</span>
                                </p>
                                <div>
                                    @foreach ($post->categories as $category)
                                        <span class="inline-block bg-blue-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                                <hr class="mt-3">
                                <a href="{{ url(route('posts.show', $post->id) . '#comments') }}" class="text-blue-500 hover:underline"><small class="mt-4">{{ $post->comments_count ?? 0 }} comments</small></a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function filterByCategory() {
        var categoryId = document.getElementById('categoryFilter').value;
        if (categoryId) {
            window.location.href = '/dashboard/category/' + categoryId;
        } else {
            window.location.href = '/dashboard';
        }
    }
</script>
