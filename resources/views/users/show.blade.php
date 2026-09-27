<x-layout title="User">
    <div class="max-w-lg mx-auto w-full space-y-6">
        <div class="p-7 rounded-2xl" style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
            <h2 class="text-xl font-bold mb-5 text-center" style="color: var(--md-text)">
                User
            </h2>

            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-3">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">ID</label>
                        <input type="text" disabled readonly
                               class="w-full px-3 py-2 rounded-lg text-sm"
                               style="background-color: var(--md-surface-2); color: var(--md-text-dim); border: 1px solid var(--md-surface-border)"
                               value="{{ $user->id }}">
                    </div>
                    <div>
                        <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Username</label>
                        <input type="text" name="username"
                               class="w-full px-3 py-2 rounded-lg text-sm focus:outline-none"
                               style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                               required value="{{ $user->username }}">
                        @error('username')
                            <x-error :message="$message"></x-error>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Email</label>
                    <input type="text" name="email"
                           class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                           style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                           required value="{{ $user->email }}">
                    @error('email')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div>
                    <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">New Password</label>
                    <input type="password" name="new_password" placeholder="Leave blank to keep current"
                           class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                           style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                    @error('new_password')
                        <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full font-semibold py-2.5 rounded-full text-sm mt-1 transition-transform duration-150 active:scale-95"
                        style="background-color: var(--md-primary); color: var(--md-on-primary)">
                    Update
                </button>
            </form>

            @can('admin-access')
                <div class="mt-6 pt-6" style="border-top: 1px solid var(--md-surface-border)">
                    <h3 class="text-sm font-bold mb-3" style="color: var(--md-text)">Tasks</h3>
                    @if(count($user->tasks) > 0)
                        <div class="space-y-2">
                            @foreach($user->tasks as $task)
                                <a href="{{ "/tasks/$task->id" }}"
                                   class="block rounded-lg px-3.5 py-2.5"
                                   style="background-color: var(--md-surface-2)">
                                    <p class="text-sm font-medium" style="color: var(--md-text)">{{ $task->title }}</p>
                                    <p class="text-xs mt-0.5" style="color: var(--md-text-dim)">Task ID: {{ $task->id }}</p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs" style="color: var(--md-text-dim)">User is not currently assigned to any tasks</p>
                    @endif
                </div>
            @endcan
        </div>

        @can('vudd', $user)
            <form action="{{ route('users.destroy', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full font-semibold py-2.5 rounded-full text-sm transition-transform duration-150 active:scale-95"
                        style="background-color: var(--md-error-container); color: var(--md-error)"
                        onclick="return confirm('Delete this account?')">
                    Delete Account
                </button>
            </form>
        @endcan
    </div>
</x-layout>
