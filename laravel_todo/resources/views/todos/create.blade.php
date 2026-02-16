@extends('layouts.app')

@section('title', 'Create New Todo')

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-0">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                    <h1 class="text-3xl font-bold text-gray-900">Create New Todo</h1>
                    <p class="mt-2 text-gray-600">Add a new task to your list and stay organized.</p>
                </div>

                @if($errors->any())
                    <div class="mx-8 mt-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <ul class="list-disc list-inside text-sm font-medium">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('todos.store') }}" method="POST" class="p-8 space-y-8">
                    @csrf

                    <div class="space-y-2">
                        <label for="title" class="text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Task Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-200 p-3"
                               placeholder="What needs to be done?"
                               required>
                    </div>                

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-200 p-3"
                                  placeholder="Add more context or steps (optional)">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="priority" class="text-sm font-bold text-gray-700 uppercase tracking-wider">
                                Priority Level
                            </label>
                            <select name="priority" 
                                    id="priority"
                                    class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-200 p-3">
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>🟢 Low Priority</option>
                                <option value="medium" {{ old('priority') == 'medium' || !old('priority') ? 'selected' : '' }}>🟡 Medium Priority</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>🔴 High Priority</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="due_date" class="text-sm font-bold text-gray-700 uppercase tracking-wider">
                                Due Date
                            </label>
                            <input type="date" 
                                   name="due_date" 
                                   id="due_date"
                                   value="{{ old('due_date') }}"
                                   class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all duration-200 p-3">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-indigo-50/50 rounded-xl border border-indigo-100">
                        <input type="checkbox" 
                               name="completed" 
                               id="completed"
                               value="1"
                               {{ old('completed') ? 'checked' : '' }}
                               class="w-5 h-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded-md transition-all duration-200">
                        <label for="completed" class="text-sm font-semibold text-indigo-900">
                            Mark as completed immediately
                        </label>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6">
                        <a href="{{ route('todos.index') }}" 
                           class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all duration-200">
                            Create Todo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection