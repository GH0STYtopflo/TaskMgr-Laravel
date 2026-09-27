@props([
    'title' => 'NA',
    'id' => '-1',
])

<a href="/categories/{{ $id }}">
    <div class="flex items-center justify-between px-4 py-3 rounded-xl transition-colors duration-150 cursor-pointer"
         style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)"
         onmouseover="this.style.backgroundColor='var(--md-surface-2)'"
         onmouseout="this.style.backgroundColor='var(--md-surface-1)'">
        <p class="font-medium text-sm" style="color: var(--md-text)">{{ $title }}</p>
        <svg class="w-4 h-4 shrink-0" style="color: var(--md-text-dim)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </div>
</a>
