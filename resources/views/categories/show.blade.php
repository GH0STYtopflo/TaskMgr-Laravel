@props(['category'])

<x-layout title="Edit Category">
    <div class="max-w-sm mx-auto w-full p-7 rounded-2xl"
         style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
        <h2 class="text-xl font-bold mb-5" style="color: var(--md-text)">
            Edit Category
        </h2>

        <form action="/categories/{{ $category->id }}" method="POST" class="space-y-3">
            @csrf
            @method('PATCH')

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Title</label>
                <input type="text" name="title"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                       required value="{{ $category->title }}">
                @error('title')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <button type="submit"
                    class="w-full font-semibold py-2.5 rounded-full text-sm transition-transform duration-150 active:scale-95"
                    style="background-color: var(--md-primary); color: var(--md-on-primary)">
                Update
            </button>
        </form>

        <form action="/categories/{{ $category->id }}" method="post" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-full font-semibold py-2.5 rounded-full text-sm transition-transform duration-150 active:scale-95"
                    style="background-color: var(--md-error-container); color: var(--md-error)"
                    onclick="return confirm('Delete this category?')">
                Delete
            </button>
        </form>
    </div>
</x-layout>
