@extends('layouts.app')

@section('title', 'My Todos')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif        

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                📋
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Todos</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                ⏳
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Active</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['active'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                ✅
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Completed</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['completed'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                🔥
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">High Priority</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['high_priority'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Header --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">My Todo List</h1>
                    <p class="mt-2 text-lg text-gray-600">Manage your tasks and stay productive.</p>
                </div>
                <a href="{{ route('todos.create') }}" 
                   class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Todo
                </a>
            </div>

            {{-- Filters & Search --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <form action="{{ route('todos.index') }}" method="GET" class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[300px] relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Find a task..."
                            class="w-full border-gray-200 rounded-xl pl-10 pr-4 py-2.5 focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all duration-200">
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <select name="status" class="border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all duration-200">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>

                        <select name="priority" class="border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all duration-200">
                            <option value="">All Priorities</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                        </select>

                        <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-xl font-medium hover:bg-black transition-colors">
                            Filter
                        </button>
                        
                        @if(request('search') || request('status') || request('priority'))
                            <a href="{{ route('todos.index') }}" class="text-sm font-medium text-red-600 hover:text-red-700 px-2">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Todo List --}}
            @if($todos->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <ul class="divide-y divide-gray-100">
                        @foreach($todos as $todo)
                            <li class="group p-6 hover:bg-gray-50/50 transition-colors {{ $todo->completed ? 'opacity-75' : '' }}">
                                <div class="flex items-start justify-between gap-6">
                                    <div class="flex-1 flex gap-4">
                                        {{-- Status Toggle Form --}}
                                        <div class="mt-1">
                                            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="group/check">
                                                    @if($todo->completed)
                                                        <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center text-white scale-110 transition-transform">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        </div>
                                                    @else
                                                        <div class="w-6 h-6 rounded-full border-2 border-gray-300 group-hover/check:border-indigo-500 transition-colors"></div>
                                                    @endif
                                                </button>
                                            </form>
                                        </div>

                                        <div class="flex-1">
                                            <div class="flex items-center flex-wrap gap-2 mb-2">
                                                <h3 class="text-lg font-bold {{ $todo->completed ? 'line-through text-gray-400' : 'text-gray-900' }}">
                                                    {{ $todo->title }}
                                                </h3>
                                                
                                                {{-- Priority Badge --}}
                                                <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-md border
                                                    {{ $todo->priority == 'high' ? 'bg-red-50 text-red-700 border-red-100' : '' }}
                                                    {{ $todo->priority == 'medium' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : '' }}
                                                    {{ $todo->priority == 'low' ? 'bg-green-50 text-green-700 border-green-100' : '' }}">
                                                    {{ $todo->priority }}
                                                </span>
                                            </div>
                                            
                                            @if($todo->description)
                                                <p class="text-gray-600 mb-4 {{ $todo->completed ? 'line-through text-gray-400' : '' }}">
                                                    {{ Str::limit($todo->description, 100) }}
                                                </p>
                                            @endif
                                            
                                            <div class="flex items-center flex-wrap gap-4 text-xs font-medium text-gray-500">
                                                @if($todo->due_date)
                                                    <div class="flex items-center gap-1.5 {{ $todo->due_date->isPast() && !$todo->completed ? 'text-red-600' : '' }}">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        <span>Due {{ $todo->due_date->format('M d, Y') }}</span>
                                                        @if($todo->due_date->isToday())
                                                            <span class="px-1.5 py-0.5 bg-orange-100 text-orange-700 rounded text-[10px]">TODAY</span>
                                                        @endif
                                                    </div>
                                                @endif
                                                
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    @if($todo->completed_at)
                                                        <span>Done {{ $todo->completed_at->diffForHumans() }}</span>
                                                    @else
                                                        <span>Added {{ $todo->created_at->diffForHumans() }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('todos.edit', $todo) }}" 
                                           class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                           title="Edit task">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline" onsubmit="return confirm('Silently delete this task?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete task">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $todos->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-dashed border-gray-300 p-20 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-indigo-50 text-indigo-500 mb-6 font-bold text-4xl">
                        ✨
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Clean Slate!</h3>
                    <p class="text-gray-500 max-w-sm mx-auto mb-8">
                        {{ request('search') || request('status') || request('priority') 
                            ? "No tasks match your filters. Try something else?" 
                            : "Your list is empty. Ready to start something new?" }}
                    </p>
                    @if(!request('search') && !request('status') && !request('priority'))
                        <a href="{{ route('todos.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create First Todo
                        </a>
                    @endif
                </div>
            @endif
        </div>
@endsection