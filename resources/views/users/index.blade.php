<x-layout title="Users">
    <div class="max-w-lg mx-auto w-full">
        <div class="p-7 rounded-2xl mb-6" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h2 class="text-xl font-bold mb-5" style="color: var(--md-text)">
                Query Users
            </h2>

            <form action="/users" method="GET" class="space-y-3">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">ID</label>
                        <input type="number" name="id"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Username</label>
                        <input type="text" name="username"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Created Before</label>
                        <input type="datetime-local" name="before"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Created After</label>
                        <input type="datetime-local" name="after"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    </div>
                </div>

                <button type="submit"
                        class="w-full font-semibold py-2.5 rounded-full text-sm mt-1 transition-transform duration-150 active:scale-95"
                        style="background-color: var(--md-primary); color: var(--md-on-primary)">
                    Lookup
                </button>
            </form>
        </div>

        <div class="space-y-2">
            @if(count($users) > 0)
                @foreach($users as $user)
                    <x-user-card :user="$user"></x-user-card>
                @endforeach
            @else
                <p class="text-sm text-center py-8" style="color: var(--md-text-dim)">No results found</p>
            @endif
        </div>
    </div>
</x-layout>
