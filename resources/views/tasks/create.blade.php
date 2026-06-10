{{-- resources/views/tasks/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Create New Task
                </h2>
                <p class="text-sm text-gray-500 mt-1">in {{ $workspace->name }}</p>
            </div>
                <x-primary-button class="px-2 py-1 text-[10px]">
        <a href="{{ route('workspaces.tasks.index', $workspace) }}">
            Back to tasks
        </a>
    </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
            <div class="p-8">
                    <form method="POST" action="{{ route('workspaces.tasks.store', $workspace) }}" class="space-y-8">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                Task Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title') }}" 
                                   class="form-input mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200"
                                   placeholder="e.g., Design homepage mockup"
                                   required>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="5" 
                                      class="form-input mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200"
                                      placeholder="Describe the task details, requirements, or notes...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status and Priority -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Status
                                </label>
                                <select name="status" 
                                        id="status" 
                                        class="form-input mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200">
                                    <option value="todo" {{ old('status') == 'todo' ? 'selected' : '' }}> To Do</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}> In Progress</option>
                                    <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}> Done</option>
                                </select>
                            </div>
                            <div>
                                <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Priority
                                </label>
                                <select name="priority" 
                                        id="priority" 
                                        class="form-input mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200">
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}> Low</option>
                                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}> Medium</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}> High</option>
                                </select>
                            </div>
                        </div>

                        <!-- Assign User and Due Date -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="assigned_user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Assign To
                                </label>
                                <select name="assigned_user_id" 
                                        id="assigned_user_id" 
                                        class="form-input mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200">
                                    <option value="">Unassigned</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}" {{ old('assigned_user_id') == $member->id ? 'selected' : '' }}>
                                            {{ $member->name }} ({{ ucfirst($member->pivot->role) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="due_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Due Date
                                </label>
                                <input type="date" 
                                       name="due_date" 
                                       id="due_date" 
                                       value="{{ old('due_date') }}"
                                       class="form-input mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200">
                                @error('due_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                                <a href="{{ route('workspaces.tasks.index', $workspace) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                Cancel
                            </a>
                         

                                <x-primary-button type="submit"  class="px-2 py-1 text-[10px]">
    Create Task
    </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>