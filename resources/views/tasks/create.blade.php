@props([
    'categories',
    'users'
])

<x-layout title="Create Task">
    <div class="max-w-lg mx-auto w-full p-7 rounded-2xl"
         style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
        <h2 class="text-xl font-bold mb-5" style="color: var(--md-text)">
            Create a new task
        </h2>

        <form action="/tasks" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Title</label>
                <input type="text" name="title" placeholder="Task title"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                       required>
                @error('title')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Description</label>
                <textarea name="description" placeholder="Description"
                          class="w-full px-3.5 py-2.5 rounded-lg text-sm resize-none focus:outline-none"
                          style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                          rows="3"></textarea>
                @error('description')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Priority</label>
                <input type="number" name="priority" placeholder="Priority"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                       required>
                @error('priority')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Categories</label>
                    <select name="categories[]" class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                            style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                            multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('categories[]')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Users</label>
                    <select name="users[]" class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                            style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                            multiple>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                    @error('users[]')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>
            </div>

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Deadline</label>
                <input type="datetime-local" name="deadline"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                       min="{{ now()->format('Y-m-d\TH:i') }}"
                       required>
                @error('deadline')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Subtasks (one per line)</label>
                <textarea name="subtasks" placeholder="Subtasks"
                          class="w-full px-3.5 py-2.5 rounded-lg text-sm resize-none focus:outline-none"
                          style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                          rows="3"></textarea>
                @error('subtasks')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <button type="submit"
                    class="w-full font-semibold py-2.5 rounded-full text-sm mt-1 transition-transform duration-150 active:scale-95"
                    style="background-color: var(--md-primary); color: var(--md-on-primary)">
                Create
            </button>
            @error('task')
                <x-error :message="$message"></x-error>
            @enderror
        </form>
    </div>
</x-layout>
