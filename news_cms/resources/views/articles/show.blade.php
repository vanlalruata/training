@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="max-w-4xl mx-auto">
        <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @if($article->image)
                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-96 object-cover">
            @endif

            <div class="p-8 md:p-12">
                <div class="flex items-center gap-4 mb-6">
                    <a href="{{ route('categories.show', $article->category->slug) }}" class="bg-red-50 text-red-600 text-sm font-bold px-3 py-1 rounded-full hover:bg-red-100 transition-colors">
                        {{ $article->category->name }}
                    </a>
                    <span class="text-gray-400">•</span>
                    <time class="text-gray-500 text-sm">{{ $article->published_at?->format('F d, Y') ?? 'Unpublished' }}</time>
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-500 text-sm">By {{ $article->user->name }}</span>
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                    {{ $article->title }}
                </h1>

                @if($article->excerpt)
                    <p class="text-xl text-gray-600 mb-8 font-medium leading-relaxed italic border-l-4 border-red-500 pl-6">
                        {{ $article->excerpt }}
                    </p>
                @endif

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-6">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <div class="mt-12 pt-8 border-t border-gray-100 italic text-gray-400">
                    <p>Status: <span class="capitalize">{{ $article->status }}</span></p>
                </div>
            </div>
        </article>

        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-red-600 flex items-center gap-2 font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to News
            </a>
            
            @auth
                @if(auth()->id() === $article->user_id)
                    <a href="{{ route('articles.edit', $article) }}" class="bg-gray-900 text-white px-6 py-2 rounded-xl font-bold hover:bg-gray-800 transition-colors shadow-sm">
                        Edit Article
                    </a>
                @endif
            @endauth
        </div>
    </div>
@endsection
