{{-- resources/views/workspaces/partials/invite-form.blade.php --}}
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Invite Team Member</h3>
        <form method="POST" action="{{ route('workspaces.invite', $workspace) }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}"
                           class="flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           placeholder="colleague@example.com"
                           required>
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">User must be registered in the system.</p>
            </div>
            <div class="flex justify-end">
            
                 <x-primary-button type="submit" class="px-2 py-1 text-[10px]">
       
            send invitation
     
    </x-primary-button>
            </div>
        </form>
    </div>
</div>