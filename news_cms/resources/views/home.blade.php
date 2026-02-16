@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-2xl p-8 mb-8">
        <h1 class="text-4xl font-bold mb-4">Latest News</h1>
        <p class="text-xl opacity-90">Stay informed with the latest updates and stories.</p>
    </div>

    {{-- Featured Articles --}}
    @if($featuredArticles->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Featured Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($featuredArticles as $article)
                    <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        @if($article->image)
                            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-sm text-red-600 font-medium">{{ $article->category->name }}</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">{{ $article->published_at?->diffForHumans() ?? 'Just now' }}</span>
                            </div>
                            <a href="{{ route('articles.show', $article->slug) }}">
                                <h3 class="text-xl font-bold text-gray-900 hover:text-red-600 transition-colors mb-2">
                                    {{ $article->title }}
                                </h3>
                            </a>
                            <p class="text-gray-600">{{ Str::limit($article->excerpt, 150) }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Latest Articles --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Latest Articles</h2>
        <div class="space-y-4">
            @forelse($latestArticles as $article)
                <article class="bg-white rounded-lg shadow-sm p-6 flex gap-4 hover:shadow-md transition-shadow">
                    @if($article->image)
                        <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-32 h-24 object-cover rounded-lg flex-shrink-0">
                    @endif
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm text-red-600 font-medium">{{ $article->category?->name ?? 'Uncategorized' }}</span>
                            <span class="text-gray-400">•</span>
                            <span class="text-sm text-gray-500">{{ $article->published_at?->format('M d, Y') ?? 'Recently' }}</span>
                        </div>
                        <a href="{{ route('articles.show', $article->slug) }}">
                            <h3 class="text-lg font-bold text-gray-900 hover:text-red-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($article->excerpt, 120) }}</p>
                    </div>
                </article>
            @empty
                <p class="text-gray-500 text-center py-8">No articles yet.</p>
            @endforelse

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $latestArticles->links() }}
            </div>
        </div>
    </div>
@endsection
