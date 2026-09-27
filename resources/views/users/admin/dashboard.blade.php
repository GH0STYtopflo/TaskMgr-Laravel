<x-layout title="Admin Dashboard">
    <div class="max-w-lg mx-auto w-full mt-4">
        <h2 class="text-sm font-bold mb-3 px-1" style="color: var(--md-text-dim)">Places</h2>
        <div class="grid grid-cols-2 gap-3">
            <a href="/users" class="p-4 rounded-xl"
               style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
                <p class="text-sm font-semibold" style="color: var(--md-text)">Users</p>
            </a>

            <a href="/tasks" class="p-4 rounded-xl"
               style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
                <p class="text-sm font-semibold" style="color: var(--md-text)">Tasks</p>
            </a>

            <a href="/categories" class="p-4 rounded-xl"
               style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
                <p class="text-sm font-semibold" style="color: var(--md-text)">Categories</p>
            </a>

            <a href="/comments" class="p-4 rounded-xl"
               style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
                <p class="text-sm font-semibold" style="color: var(--md-text)">Comments</p>
            </a>
        </div>
    </div>
</x-layout>
