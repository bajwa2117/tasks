{{-- resources/views/tasks/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Task Details
                </h2>
                <p class="text-sm text-gray-500 mt-1">View and manage task information</p>
            </div>
            <div class="space-x-3">
                @can('update', $task)
                    <a href="{{ route('workspaces.tasks.edit', [$workspace, $task]) }}" 
                       class="btn-primary inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Task
                    </a>
                @endcan
                <a href="{{ route('workspaces.tasks.index', $workspace) }}" 
                   class="inline-flex items-center px-5 py-2.5 bg-gray-100 border border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-200 transition-all duration-200">
                    ← Back to Tasks
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                <div class="p-8">
                    <!-- Header with Priority and Status -->
                    <div class="flex justify-between items-start mb-8 pb-6 border-b border-gray-200">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $task->title }}</h1>
                            </div>
                            <div class="flex space-x-3">
                                <span class="badge-status priority-{{ $task->priority }} px-3 py-1.5 text-sm font-semibold rounded-full shadow-sm">
                                    @if($task->priority == 'high') High Priority
                                    @elseif($task->priority == 'medium')  Medium Priority
                                    @else  Low Priority
                                    @endif
                                </span>
                                <span class="badge-status status-{{ $task->status }} px-3 py-1.5 text-sm font-semibold rounded-full shadow-sm">
                                    @if($task->status == 'todo')  To Do
                                    @elseif($task->status == 'in_progress') In Progress
                                    @else  Done
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Created {{ $task->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-gray-400">by {{ $task->creator->name }}</p>
                        </div>
                    </div>

                    <!-- Description Section with Gradient Background -->
                    @if($task->description)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                Description
                            </h3>
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-5 border border-gray-200">
                                <p class="text-gray-700 leading-relaxed">{{ $task->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Details Grid with Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl p-5 border border-indigo-100">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Assigned To</h3>
                                    <p class="text-gray-900 font-medium">{{ $task->assignedUser ? $task->assignedUser->name : 'Unassigned' }}</p>
                                    @if($task->assignedUser)
                                        <p class="text-xs text-gray-500">{{ $task->assignedUser->email }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-5 border border-purple-100">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Due Date</h3>
                                    <p class="text-gray-900 font-medium">{{ $task->due_date ? $task->due_date->format('F j, Y') : 'No due date set' }}</p>
                                    @if($task->due_date && $task->due_date->isPast() && $task->status != 'done')
                                        <p class="text-xs text-red-500 mt-1">Overdue</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Workspace Info -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-5 mb-8 border border-gray-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Workspace</h3>
                                <p class="text-gray-700">{{ $workspace->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Log (Enhanced) -->
                    @if(isset($task->activities) && $task->activities && $task->activities->count() > 0)
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Activity Timeline
                            </h3>
                            <div class="space-y-3">
                                @foreach($task->activities->take(10) as $activity)
                                    <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                        <div class="w-2 h-2 mt-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-700">
                                                <span class="font-semibold text-gray-900">{{ $activity->user->name }}</span>
                                                <span class="text-gray-600">{{ $activity->action }}</span>
                                                <span class="text-gray-500">this task</span>
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>