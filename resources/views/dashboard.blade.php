{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <x-primary-button class="ms-3" onclick="window.location='{{ route('workspaces.create') }}'">
                {{ __('Create Workspace') }}
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid - Three cards in one line -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
                <!-- My Workspaces Card -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-indigo-100 rounded-lg">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">My Workspaces</h3>
                            </div>
                          
                        </div>
                        
                        <p class="text-3xl font-bold text-gray-900 mb-2">
                            {{ auth()->user()->workspaces->count() }}
                        </p>
                        
                        <p class="text-sm text-gray-600">
                            Active workspaces you own or belong to
                        </p>
                     
                    </div>
                </div>

                <!-- Assigned Tasks Card -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Assigned Tasks</h3>
                            </div>
                        
                        </div>
                        
                        <p class="text-3xl font-bold text-gray-900 mb-2">
                            {{ auth()->user()->assignedTasks->count() }}
                        </p>
                        
                        <p class="text-sm text-gray-600">
                            Tasks assigned to you across all workspaces
                        </p>
                    </div>
                </div>

                <!-- Notifications Card -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-yellow-100 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
                            </div>
                          
                        </div>
                        
                        <p class="text-3xl font-bold text-gray-900 mb-2">
                            {{ auth()->user()->notifications->count() }}
                        </p>
                        
                        <p class="text-sm text-gray-600">
                            Total notifications received
                        </p>
                        
                 
                    </div>
                </div>
            </div>

            <!-- Rest of your content remains the same -->
            <!-- Recent Workspaces -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mt-4">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Workspaces</h3>
                    <div class="space-y-3">
                        @forelse(auth()->user()->workspaces->take(5) as $workspace)
                            <div class="flex items-center justify-between border-b pb-3">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $workspace->name }}</p>
                                    <p class="text-sm text-gray-500">Role: {{ ucfirst($workspace->pivot->role) }}</p>
                                </div>
                                <a href="{{ route('workspaces.show', $workspace) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                    View →
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No workspaces yet. Create your first workspace!</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Notifications -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Notifications</h3>
                    <div class="space-y-3">
                        @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                            <div class="border-l-4 border-indigo-400 bg-indigo-50 p-4 rounded">
                                <p class="text-sm text-gray-700">{{ $notification->data['message'] ?? 'New notification' }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No new notifications</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>