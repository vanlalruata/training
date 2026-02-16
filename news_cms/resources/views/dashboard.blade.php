@extends('layouts.app')

@section('title', 'CMS Dashboard')

@section('content')
    <div class="space-y-8">
        {{-- Welcome --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-600 text-lg">Your news desk is ready. Here's what's happening today.</p>
                </div>
                <a href="{{ route('articles.create') }}" class="w-full md:w-auto bg-primary-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-primary-700 transition-all hover:-translate-y-1 shadow-lg shadow-primary-100 flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Article
                </a>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="bg-blue-50 text-blue-600 p-4 rounded-xl">
                    <i data-lucide="newspaper" class="w-8 h-8"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-tight">Total Posts</div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="bg-green-50 text-green-600 p-4 rounded-xl">
                    <i data-lucide="check-circle" class="w-8 h-8"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['published'] }}</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-tight">Published</div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="bg-amber-50 text-amber-600 p-4 rounded-xl">
                    <i data-lucide="file-edit" class="w-8 h-8"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['draft'] }}</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-tight">Drafts</div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5">
                <div class="bg-red-50 text-red-600 p-4 rounded-xl">
                    <i data-lucide="star" class="w-8 h-8"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['featured'] }}</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-tight">Featured</div>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-xl text-gray-900">Recent Headlines</h3>
                </div>
                <div class="p-6">
                    <a href="{{ route('articles.index') }}" class="text-primary-600 hover:text-primary-700 font-bold flex items-center justify-center gap-2 py-4 border-2 border-dashed border-gray-200 rounded-xl hover:border-primary-200 transition-all">
                        View Editorial Queue
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-xl text-gray-900">Editorial Support</h3>
                </div>
                <div class="p-8 text-center">
                    <div class="bg-primary-50 text-primary-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="help-circle" class="w-8 h-8"></i>
                    </div>
                    <p class="text-gray-600 mb-6">Need help with our editorial tools? Check our documentation.</p>
                    <button class="bg-gray-100 text-gray-700 px-6 py-2 rounded-xl font-bold hover:bg-gray-200 transition-colors">
                        Get Help
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Lucide Icons initialization -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
@endsection
