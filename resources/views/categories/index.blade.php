@props([
    'categories' => []
])

<x-layout title="Categories">
    <div class="max-w-lg mx-auto w-full">
        <div class="p-7 rounded-2xl mb-6" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h2 class="text-xl font-bold mb-5" style="color: var(--md-text)">
                Create a new category
            </h2>

            <form action="/categories" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Title</label>
                    <input type="text" name="title" placeholder="Category title"
                           class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                           style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                           required>
                    @error('title')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>
                <button type="submit"
                        class="w-full font-semibold py-2.5 rounded-full text-sm transition-transform duration-150 active:scale-95"
                        style="background-color: var(--md-primary); color: var(--md-on-primary)">
                    Create
                </button>
            </form>
        </div>

        <h3 class="text-sm font-bold mb-3 px-1" style="color: var(--md-text-dim)">Existing Categories</h3>
        <div class="space-y-2">
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <x-card :title="$category->title" :id="$category->id"></x-card>
                @endforeach
            @else
                <p class="text-sm text-center py-8" style="color: var(--md-text-dim)">No categories found. Start by creating one.</p>
            @endif
        </div>
    </div>
</x-layout>
