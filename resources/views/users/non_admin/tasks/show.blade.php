@props([
    'task',
])

<x-layout title="Task">
    <div class="max-w-lg mx-auto w-full space-y-6">
        <div class="p-7 rounded-2xl" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h2 class="text-xl font-bold mb-5" style="color: var(--md-text)">
                {{ $task->title }}
            </h2>

            <form action="/users/{{ Auth::user()->id }}/tasks/{{ $task->id }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <p class="text-xs font-medium mb-1" style="color: var(--md-text-dim)">Description</p>
                    <p class="text-sm" style="color: var(--md-text)">{{ $task->description }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium mb-1" style="color: var(--md-text-dim)">Priority</p>
                    <p class="text-sm" style="color: var(--md-text)">{{ $task->priority }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-medium mb-1.5" style="color: var(--md-text-dim)">Categories</p>
                        <ul class="space-y-0.5">
                            @foreach($task->categories as $category)
                                <li class="text-sm" style="color: var(--md-text)">{{ $category->title }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <p class="text-xs font-medium mb-1.5" style="color: var(--md-text-dim)">Users</p>
                        <ul class="space-y-0.5">
                            @foreach($task->users as $user)
                                <li class="text-sm" style="color: var(--md-text)">{{ $user->username }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-medium mb-1" style="color: var(--md-text-dim)">Deadline</p>
                    <p class="text-sm" style="color: var(--md-text)">{{ (new DateTimeImmutable($task->deadline))->format('Y-m-d H:i:s') }}</p>
                </div>

                <label class="flex items-center gap-2.5 py-1 cursor-pointer">
                    <input type="checkbox" name="task_is_done" class="w-4 h-4 rounded cursor-pointer accent-purple-400" @if($task->status == 'COMPLETED') checked @endif>
                    <span class="text-sm" style="color: var(--md-text)">Set Finished</span>
                </label>
                @error('finished')
                    <x-error :message="$message"></x-error>
                @enderror

                <button type="submit"
                        class="w-full font-semibold py-2.5 rounded-full text-sm transition-transform duration-150 active:scale-95"
                        style="background-color: var(--md-primary); color: var(--md-on-primary)">
                    Submit changes
                </button>
            </form>
        </div>

        <!-- Subtasks -->
        <div class="p-7 rounded-2xl" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h3 class="text-sm font-bold mb-3" style="color: var(--md-text)">Subtasks</h3>

            @if(count($task->subtasks) > 0)
                <div class="space-y-2">
                    @foreach($task->subtasks as $subtask)
                        <form action="{{ route('tasks.subtasks.status', [Auth::user(), $task, $subtask]) }}" method="post"
                              class="flex items-center gap-2.5 p-2.5 rounded-lg" style="background-color: var(--md-surface-2)">
                            @csrf
                            @method('PATCH')

                            <span class="text-sm flex-1" style="color: var(--md-text)">{{ $subtask->title }}</span>

                            <input type="checkbox" name="is_done" class="w-4 h-4 rounded cursor-pointer accent-purple-400" @if($subtask->is_completed) checked @endif>

                            <button type="submit" class="px-3 py-1.5 rounded-full text-xs font-semibold"
                                    style="background-color: var(--md-primary); color: var(--md-on-primary)">
                                Update
                            </button>
                        </form>
                    @endforeach
                </div>
            @else
                <p class="text-xs" style="color: var(--md-text-dim)">No subtasks</p>
            @endif
            @error('subtasks')
                <x-error :message="$message"></x-error>
            @enderror
        </div>

        <!-- Comments -->
        <div class="p-7 rounded-2xl" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h3 class="text-sm font-bold mb-3" style="color: var(--md-text)">Comments</h3>

            <form action="{{ "/tasks/" . $task->id . "/comments" }}" method="POST" class="mb-4">
                @csrf
                <input type="text" name="body" placeholder="Add a comment..."
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm mb-2 focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                @error('title')
                    <x-error :message="$message"></x-error>
                @enderror
                <button type="submit"
                        class="w-full font-semibold py-2 rounded-full text-sm transition-transform duration-150 active:scale-95"
                        style="background-color: var(--md-primary); color: var(--md-on-primary)">
                    Comment
                </button>
            </form>

            <div class="space-y-2">
                @if(count($comments) > 0)
                    @foreach($comments as $comment)
                        <x-comment-card :comment="$comment"></x-comment-card>
                    @endforeach
                @else
                    <p class="text-xs" style="color: var(--md-text-dim)">No Comments for this task</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
