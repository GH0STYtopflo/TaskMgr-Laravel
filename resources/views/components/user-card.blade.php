<a href="{{ "/users/$user->id" }}" class="block">
    <div class="rounded-xl px-4 py-3.5 transition-colors duration-150"
         style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)"
         onmouseover="this.style.backgroundColor='var(--md-surface-2)'"
         onmouseout="this.style.backgroundColor='var(--md-surface-1)'">
        <div class="flex justify-between items-baseline">
            <p class="font-semibold text-sm" style="color: var(--md-text)">{{ $user->username }}</p>
            <p class="text-xs" style="color: var(--md-text-dim)">#{{ $user->id }}</p>
        </div>
        <p class="text-xs mt-1" style="color: var(--md-text-dim)">Joined {{ \Carbon\Carbon::parse($user->created_at)->format('M Y') }}</p>
    </div>
</a>
