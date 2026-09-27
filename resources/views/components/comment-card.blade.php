<div class="rounded-xl px-4 py-3.5" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
    <div class="flex justify-between items-baseline mb-2.5">
        <p class="font-semibold text-sm" style="color: var(--md-text)">{{ $comment->user->username }}</p>
        <p class="text-xs" style="color: var(--md-text-dim)">
            {{ (new DateTimeImmutable($comment->created_at))->setTimezone(new DateTimeZone('Asia/Tehran'))->format('M d, H:i') }}
        </p>
    </div>

    <form method="POST" action="{{ "/tasks/" . $comment->task->id . "/comments/" . $comment->id }}">
        <textarea
            name="body"
            class="w-full text-sm rounded-lg px-3 py-2 resize-none focus:outline-none"
            style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
            rows="2"
            {{ !($comment->user->is(Auth::user()) || Auth::user()->is_admin) ? 'readonly' : '' }}>{{ $comment->body }}</textarea>

        @if($comment->user->is(Auth::user()))
            @csrf
            @method('PATCH')
            <button type="submit"
                    class="w-full mt-2 text-xs font-semibold py-1.5 rounded-full transition-transform duration-150 active:scale-95"
                    style="background-color: var(--md-primary); color: var(--md-on-primary)">
                Update
            </button>
        @endif
    </form>

    @if($comment->user->is(Auth::user()) || Auth::user()->is_admin)
        <form class="mt-1.5" method="POST" action="{{ "/tasks/" . $comment->task->id . "/comments/" . $comment->id }}">
            @csrf
            @method('DELETE')

            <button type="submit"
                    class="w-full text-xs font-semibold py-1.5 rounded-full transition-transform duration-150 active:scale-95"
                    style="background-color: var(--md-error-container); color: var(--md-error)">
                Delete
            </button>
        </form>
    @endif
</div>
