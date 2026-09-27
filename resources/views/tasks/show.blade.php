@props([
    'task'
])

<x-layout title="Edit Task">
    <div class="max-w-lg mx-auto w-full space-y-6">
        <!-- Edit Form -->
        <div class="p-7 rounded-2xl" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h2 class="text-xl font-bold mb-5" style="color: var(--md-text)">
                Edit Task
            </h2>

            <form action="/tasks/{{ $task->id }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Title</label>
                    <input type="text" name="title"
                           class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                           style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                           required
                           value="{{ $task->title }}">
                    @error('title')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Description</label>
                    <textarea name="description"
                              class="w-full px-3.5 py-2.5 rounded-lg text-sm resize-none focus:outline-none"
                              style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                              rows="3">{{ $task->description }}</textarea>
                    @error('description')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Priority</label>
                    <input type="number" name="priority"
                           class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                           style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                           required value="{{ $task->priority }}">
                    @error('priority')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Categories</label>
                        <select name="categories[]" class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                                style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                                multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($task->categories->contains($category)) selected @endif>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories[]')
                            <x-error :message="$message"></x-error>
                        @enderror
                    </div>

                    <div>
                        <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Users</label>
                        <select name="users[]" class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                                style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                                multiple>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($task->users->contains($user)) selected @endif>
                                    {{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                        @error('users[]')
                            <x-error :message="$message"></x-error>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Deadline</label>
                    <input type="datetime-local" name="deadline"
                           class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                           style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                           required
                           value="{{ (new DateTimeImmutable($task->deadline))->format('Y-m-d\TH:i:s') }}">
                    @error('deadline')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">New subtasks (one per line)</label>
                    <textarea name="subtasks"
                              class="w-full px-3.5 py-2.5 rounded-lg text-sm resize-none focus:outline-none"
                              style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                              rows="2"></textarea>
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
                    Save Changes
                </button>
                @error('update')
                    <x-error :message="$message"></x-error>
                @enderror
            </form>

            <form action="/tasks/{{ $task->id }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full font-semibold py-2.5 rounded-full text-sm transition-transform duration-150 active:scale-95"
                        style="background-color: var(--md-error-container); color: var(--md-error)"
                        onclick="return confirm('Delete this task?')">
                    Delete
                </button>
            </form>
        </div>

        <!-- Subtasks -->
        <div class="p-7 rounded-2xl" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h3 class="text-sm font-bold mb-3" style="color: var(--md-text)">Subtasks</h3>

            @if(count($task->subtasks) > 0)
                <div class="space-y-2">
                    @foreach($task->subtasks as $subtask)
                        <div class="flex items-center gap-2 p-2.5 rounded-lg" style="background-color: var(--md-surface-2)">
                            <form action="{{ route('tasks.subtasks.update', [$task, $subtask]) }}" method="post" class="flex-1 flex items-center gap-2">
                                @csrf
                                @method('PATCH')

                                <input type="text" name="title"
                                       class="flex-1 px-2.5 py-1.5 rounded text-sm focus:outline-none"
                                       style="background-color: var(--md-surface-1); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                                       required
                                       value="{{ $subtask->title }}">

                                <input type="checkbox" name="is_done" class="w-4 h-4 rounded cursor-pointer accent-purple-400" @if($subtask->is_completed) checked @endif>

                                <button type="submit" class="px-3 py-1.5 rounded-full text-xs font-semibold"
                                        style="background-color: var(--md-primary); color: var(--md-on-primary)">
                                    Update
                                </button>
                            </form>

                            <form action="{{ route('tasks.subtasks.destroy', [$task, $subtask]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-full text-xs font-semibold"
                                        style="background-color: var(--md-error-container); color: var(--md-error)">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs" style="color: var(--md-text-dim)">No subtasks yet.</p>
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
                    <p class="text-xs" style="color: var(--md-text-dim)">No comments for this task</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
