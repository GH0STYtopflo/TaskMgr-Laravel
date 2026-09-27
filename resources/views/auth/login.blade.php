<x-layout title="Login">
    <div class="max-w-sm mx-auto mt-10 p-7 rounded-3xl"
         style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
        <h2 class="text-2xl font-bold text-center mb-6" style="color: var(--md-text)">
            Welcome Back
        </h2>

        <form action="/login" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Username</label>
                <input type="text" name="username" placeholder="Enter your username"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                       required>
                @error('username')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Password</label>
                <input type="password" name="password" placeholder="Enter your password"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                       required>
                @error('password')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            @error('credentials')
                <x-error :message="$message"></x-error>
            @enderror

            <button type="submit"
                    class="w-full font-semibold py-2.5 rounded-full text-sm mt-2 transition-transform duration-150 active:scale-95"
                    style="background-color: var(--md-primary); color: var(--md-on-primary)">
                Sign In
            </button>

            <p class="text-center text-xs pt-1" style="color: var(--md-text-dim)">
                Don't have an account?
                <a href="{{ route('signup') }}" class="font-semibold" style="color: var(--md-primary)">Sign up</a>
            </p>
        </form>
    </div>
</x-layout>
