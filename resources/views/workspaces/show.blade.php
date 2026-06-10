{{-- resources/views/workspaces/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $workspace->name }}
            </h2>
               <x-primary-button class="px-2 py-1 text-[10px] bg-gray-600 hover:bg-gray-700">
        <a href="{{ route('workspaces.tasks.index', $workspace) }}">
            View All Tasks
        </a>
    </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Workspace Info -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Workspace Information</h3>
                        <span class="px-3 py-1 text-sm rounded-full {{ $workspace->isOwner(auth()->user()) ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $workspace->isOwner(auth()->user()) ? 'Owner' : 'Member' }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Owner</p>
                            <p class="font-medium">{{ $workspace->owner->name }}</p>
                            <p class="text-xs text-gray-400">{{ $workspace->owner->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Created</p>
                            <p class="font-medium">{{ $workspace->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Team Members ({{ $workspace->users->count() }})</h3>
                    <div class="space-y-3">
                        @foreach($workspace->users as $member)
                            <div class="flex items-center justify-between border-b pb-3 last:border-0">
                                <div class="flex items-center space-x-3">
                                  
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $member->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $member->email }}</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full {{ $member->pivot->role == 'owner' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($member->pivot->role) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Invite Form (Only for Owners) -->
            @can('manage', $workspace)
                @include('workspaces.partials.invite-form')
            @endcan

          
        </div>
    </div>
</x-app-layout>