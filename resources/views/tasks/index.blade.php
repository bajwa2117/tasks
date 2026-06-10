{{-- resources/views/tasks/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Tasks Dashboard
                </h2>
                <p class="text-sm text-gray-500 mt-1">{{ $workspace->name }} • Manage and track your team's progress</p>
            </div>
              <x-primary-button class="px-2 py-1 text-[10px]">
        <a href="{{ route('workspaces.tasks.create', $workspace) }}">
            Create New Task
        </a>
    </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm animate-slideDown">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Enhanced Filter Form -->
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden rounded-2xl mb-8 border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        
                        Filter Tasks
                    </h3>
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="form-input w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200">
                                <option value="">All Status</option>
                                <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>📋 To Do</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>⚡ In Progress</option>
                                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>✅ Done</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Assigned To</label>
                            <select name="assigned_user" class="form-input w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200">
                                <option value="">All Members</option>
                                @foreach($workspace->users as $member)
                                    <option value="{{ $member->id }}" {{ request('assigned_user') == $member->id ? 'selected' : '' }}>
                                        👤 {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                           
                                 <x-primary-button type="submit"  class="px-2 py-1 text-[10px]">
      
            Apply Filters
        
    </x-primary-button>
                        </div>
                        <div class="flex items-end">
                          

                             <x-primary-button class="px-2 py-1 text-[10px]">
        <a href="{{ route('workspaces.tasks.index', $workspace) }}">
            Reset Filters
        </a>
    </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Enhanced Tasks Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tasks as $task)
                    <div class="task-card bg-white overflow-hidden rounded-2xl transition-all duration-300 border border-gray-100">
                        <div class="p-6">
                            <!-- Priority and Status Badges -->
                            <div class="flex justify-between items-start mb-4">
                                <span class="badge-status priority-{{ $task->priority }} px-3 py-1 text-xs font-semibold rounded-full shadow-sm">
                                    @if($task->priority == 'high')  High
                                    @elseif($task->priority == 'medium')  Medium
                                    @else  Low
                                    @endif
                                </span>
                                <span class="badge-status status-{{ $task->status }} px-3 py-1 text-xs font-semibold rounded-full shadow-sm">
                                    @if($task->status == 'todo') To Do
                                    @elseif($task->status == 'in_progress')  In Progress
                                    @else  Done
                                    @endif
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 hover:text-indigo-600 transition-colors duration-200">
                                {{ $task->title }}
                            </h3>

                            <!-- Description -->
                            @if($task->description)
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    {{ Str::limit($task->description, 80) }}
                                </p>
                            @endif

                            <!-- Assigned User & Due Date -->
                            <div class="flex items-center justify-between mb-4 pt-2 border-t border-gray-100">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">
                                        {{ $task->assignedUser ? $task->assignedUser->name : 'Unassigned' }}
                                    </span>
                                </div>
                                @if($task->due_date)
                                    <div class="flex items-center space-x-1 bg-gray-50 px-2 py-1 rounded-lg">
                                        <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-xs text-gray-600">{{ $task->due_date->format('M d, Y') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center pt-3">
                                <a href="{{ route('workspaces.tasks.show', [$workspace, $task]) }}" 
                                   class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium text-sm transition-colors duration-200">
                                    View Details
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                @can('update', $task)
                                    <a href="{{ route('workspaces.tasks.edit', [$workspace, $task]) }}" 
                                       class="text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-gradient-to-br from-gray-50 to-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                            <div class="p-12 text-center">
                                <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">No tasks found</h3>
                                <p class="text-gray-500 mb-6">Get started by creating your first task in this workspace.</p>
                              <x-primary-button class="px-2 py-1 text-[10px]">
        <a href="{{ route('workspaces.tasks.create', $workspace) }}">
            Create New Task
        </a>
    </x-primary-button>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>