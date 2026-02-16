@extends('layouts.app')

@section('title', 'Edit Article - ' . $article->title)

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h1 class="text-3xl font-bold text-gray-900">Edit Article</h1>
                <p class="text-gray-500 mt-2">Refine your story and keep your readers updated.</p>
            </div>

            @if($errors->any())
                <div class="mx-8 mt-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow-sm flex items-start gap-3">
                    <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <ul class="list-disc list-inside text-sm font-medium">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('articles.update', $article) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label for="title" class="text-sm font-bold text-gray-700 uppercase tracking-wider">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}"
                           class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all duration-200 p-3"
                           required>
                </div>

                <div class="space-y-2">
                    <label for="category_id" class="text-sm font-bold text-gray-700 uppercase tracking-wider">Category</label>
                    <select name="category_id" id="category_id" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all duration-200 p-3">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="excerpt" class="text-sm font-bold text-gray-700 uppercase tracking-wider">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" rows="2"
                              class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all duration-200 p-3">{{ old('excerpt', $article->excerpt) }}</textarea>
                    <p class="text-xs text-gray-400">A brief summary of your article shown in listings.</p>
                </div>

                <div class="space-y-2">
                    <label for="content" class="text-sm font-bold text-gray-700 uppercase tracking-wider">Content *</label>
                    <textarea name="content" id="content" rows="12"
                              class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all duration-200 p-3" required>{{ old('content', $article->content) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-start gap-3">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $article->featured) ? 'checked' : '' }}
                                   class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        </div>
                        <div class="text-sm">
                            <label for="featured" class="font-bold text-gray-700">Featured Article</label>
                            <p class="text-gray-500">Highlight this article on the home page.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label for="status" class="text-sm font-bold text-gray-700">Status</label>
                        <select name="status" id="status" class="block w-full rounded-lg border-gray-200 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm">
                            <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-6">
                    <a href="{{ route('articles.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-800 transition-colors">
                        Discard Changes
                    </a>
                    <button type="submit" class="px-10 py-3 bg-red-600 text-white rounded-xl font-bold shadow-lg shadow-red-100 hover:bg-red-700 hover:-translate-y-0.5 transition-all duration-200">
                        Update Article
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
