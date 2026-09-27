@php
    use Carbon\Carbon;
    $expired = Carbon::parse($task->deadline)->isPast();
@endphp

<a
    @if (!$expired && !Auth::user()->is_admin)
        href="{{ route('users.tasks.nonAdminShow', [Auth::user(), $task]) }}"
    @elseif (Auth::user()->is_admin)
        href="{{ route('tasks.show', $task)}}"
    @endif
    class="{{ $expired && !Auth::user()->is_admin ? 'cursor-not-allowed' : 'cursor-pointer' }} block"
>
    <div
        class="flex items-start justify-between gap-3 rounded-xl px-4 py-3.5 transition-colors duration-150 {{ $expired ? 'opacity-60' : '' }}"
        style="background-color: {{ $expired ? 'var(--md-error-container)' : 'var(--md-surface-1)' }}; border: 1px solid var(--md-surface-border)"
    >
        <div class="min-w-0 flex-1">
            <p class="font-semibold text-sm truncate" style="color: var(--md-text)">
                {{ $task->title }}
            </p>

            <p class="text-xs mt-1 line-clamp-2" style="color: var(--md-text-dim)">
                {{ $task->description }}
            </p>

            <p class="text-xs mt-2" style="color: {{ $expired ? 'var(--md-error)' : 'var(--md-text-dim)' }}">
                {{ $expired ? 'Expired' : 'Due ' . Carbon::parse($task->deadline)->format('M d, Y') }}
            </p>
        </div>

        <div class="px-2.5 py-1 rounded-full text-xs font-semibold shrink-0"
             style="background-color: {{ $expired ? '#7a2020' : 'var(--md-primary-container)' }}; color: {{ $expired ? 'var(--md-error)' : 'var(--md-primary)' }}">
            {{ $task->status == 'COMPLETED' ? '✓' : $task->status }}
        </div>
    </div>
</a>
