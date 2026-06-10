{{-- resources/views/workspaces/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Workspaces') }}
            </h2>
         <x-primary-button class="ms-3" onclick="window.location='{{ route('workspaces.create') }}'">
                {{ __('Create Workspace') }}
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($workspaces as $workspace)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $workspace->name }}</h3>
                                <span class="px-2 py-1 text-xs rounded-full {{ $workspace->pivot->role == 'owner' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($workspace->pivot->role) }}
                                </span>
                            </div>
                            
                            <p class="text-sm text-gray-600 mb-2">
                                <strong>Owner:</strong> {{ $workspace->owner->name }}
                            </p>
                            
                            <p class="text-sm text-gray-600 mb-4">
                                <strong>Members:</strong> {{ $workspace->users->count() }}
                            </p>
                            
                            <div class="flex justify-between items-center">
                                <a href="{{ route('workspaces.show', $workspace) }}" 
                                   class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                    Open Workspace
                                </a>
                                <span class="text-xs text-gray-400">{{ $workspace->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                            <div class="p-6 text-center">
                                <p class="text-gray-500 mb-4">You don't have any workspaces yet.</p>
                               <x-primary-button class="ms-3"
    onclick="window.location='{{ route('workspaces.create') }}'">
    {{ __('Create Workspace') }}
</x-primary-button>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>