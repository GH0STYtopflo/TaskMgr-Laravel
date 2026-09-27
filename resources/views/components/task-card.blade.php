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
    class="{{ $expired && !Auth::user()->is_admin ? 'cursor-not-allowed' : 'cursor-pointer' }}"
>
    <div
        class="flex items-center justify-between rounded-xl p-5 w-full mb-3
            {{ $expired ? 'bg-red-950 opacity-75' : '' }}"
        @if (!$expired)
            style="background-color: #08032a"
        @endif
    >

        <div class="space-y-1">
            <p class="text-white font-bold">
                {{ $task->title }}
            </p>

            <p class="text-white text-sm truncate">
                {{ $task->description }}
            </p>

            <p class="text-white mt-5 text-xs">
                {{ $expired ? 'expired' : 'Deadline: ' . $task->deadline }}
            </p>
        </div>

        <div class="ml-6 px-4 py-3 rounded-2xl text-xs font-bold
            {{ $expired ? 'bg-red-600' : 'bg-purple-500' }} text-white shrink-0">
            {{ $task->status }}
        </div>

    </div>
</a>
