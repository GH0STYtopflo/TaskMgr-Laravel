@props([
    'tasks'
])

<x-layout title="Tasks">
    <div class="max-w-3xl mx-auto w-full">
        <!-- Filter Panel -->
        <div class="p-6 rounded-2xl mb-6" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h2 class="text-lg font-bold mb-4" style="color: var(--md-text)">Filter Tasks</h2>

            <form action="{{ route('tasks.index') }}" method="GET" class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium block mb-1" style="color: var(--md-text-dim)">Priority less than</label>
                        <input type="number" name="plt"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1" style="color: var(--md-text-dim)">Priority greater than</label>
                        <input type="number" name="pgt"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1" style="color: var(--md-text-dim)">Created before</label>
                        <input type="datetime-local" name="created_before"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1" style="color: var(--md-text-dim)">Created after</label>
                        <input type="datetime-local" name="created_after"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1" style="color: var(--md-text-dim)">Deadline before</label>
                        <input type="datetime-local" name="deadline_before"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1" style="color: var(--md-text-dim)">Deadline after</label>
                        <input type="datetime-local" name="deadline_after"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1" style="color: var(--md-text-dim)">Status</label>
                        <select name="status" class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                                style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                            <option value="">Any status</option>
                            <option value="ONGOING">Ongoing</option>
                            <option value="COMPLETED">Completed</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1" style="color: var(--md-text-dim)">Order by</label>
                        <select name="order_by" class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                                style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                            <option value="created_at">Created at</option>
                            <option value="updated_at">Updated at</option>
                            <option value="status">Status</option>
                            <option value="deadline">Deadline</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-2 pt-1">
                    <button type="submit"
                            class="flex-1 font-semibold py-2 rounded-full text-sm transition-transform duration-150 active:scale-95"
                            style="background-color: var(--md-primary); color: var(--md-on-primary)">
                        Query
                    </button>
                    <a href="{{ route('tasks.create') }}"
                       class="flex-1 text-center font-semibold py-2 rounded-full text-sm transition-colors duration-150"
                       style="background-color: var(--md-primary-container); color: var(--md-primary)">
                        + New Task
                    </a>
                </div>
            </form>
        </div>

        <!-- Tasks -->
        @if(count($tasks) > 0)
            <div class="space-y-2">
                @foreach($tasks as $task)
                    <x-task-card :task="$task" />
                @endforeach
            </div>
        @else
            <p class="text-sm text-center py-8" style="color: var(--md-text-dim)">No tasks available</p>
        @endif
    </div>
</x-layout>
