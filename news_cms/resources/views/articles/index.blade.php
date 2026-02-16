@extends('layouts.app')

@section('title', 'All Articles')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">
                @if(isset($currentCategory))
                    Category: {{ $currentCategory->name }}
                @elseif(isset($currentTag))
                    Tag: {{ $currentTag->name }}
                @else
                    All Articles
                @endif
            </h1>
            
            @auth
                <a href="{{ route('articles.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                    Create Article
                </a>
            @endauth
        </div>

        <div class="p-6">
            {{-- Filtering/Search could go here --}}
            <div class="mb-6 flex gap-4 overflow-x-auto pb-2">
                <a href="{{ route('articles.index') }}" class="px-4 py-2 rounded-full border {{ !isset($currentCategory) ? 'bg-red-600 text-white border-red-600' : 'bg-gray-50 text-gray-600 hover:bg-gray-100' }}">
                    All
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" 
                       class="px-4 py-2 rounded-full border {{ (isset($currentCategory) && $currentCategory->id == $category->id) ? 'bg-red-600 text-white border-red-600' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 whitespace-nowrap' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <div class="space-y-6">
                @forelse($articles as $article)
                    <div class="flex items-start justify-between border-b border-gray-100 pb-6 last:border-0 last:pb-0">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="bg-red-50 text-red-600 text-xs font-bold px-2 py-0.5 rounded uppercase">
                                    {{ $article->category?->name ?? 'Uncategorized' }}
                                </span>
                                <span class="text-xs text-gray-400">
                                    {{ $article->published_at?->format('M d, Y') ?? 'Recently' }}
                                </span>
                                <span class="text-xs text-gray-400">by {{ $article->user->name }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 hover:text-red-600 transition-colors">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="text-gray-600 mt-2 line-clamp-2">{{ $article->excerpt }}</p>
                        </div>
                        
                        @auth
                            <div class="flex gap-2 ml-4">
                                <a href="{{ route('articles.edit', $article) }}" class="text-blue-600 hover:underline text-sm font-medium">Edit</a>
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        @endauth
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-8">No articles found matching your criteria.</p>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
