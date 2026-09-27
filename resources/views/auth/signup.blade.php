<x-layout title="Signup">
    <div class="max-w-sm mx-auto mt-10 p-7 rounded-3xl"
         style="background-color: var(--md-surface-1); border: 1px solid var(--md-surface-border)">
        <h2 class="text-2xl font-bold text-center mb-6" style="color: var(--md-text)">
            Create Account
        </h2>

        <form action="/signup" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Username</label>
                <input type="text" name="username" placeholder="Choose a username"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                       required>
                @error('username')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Email</label>
                <input type="email" name="email" placeholder="your@email.com"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)">
                @error('email')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <div>
                <label class="text-xs font-medium block mb-1.5" style="color: var(--md-text-dim)">Password</label>
                <input type="password" name="password" placeholder="Create a password"
                       class="w-full px-3.5 py-2.5 rounded-lg text-sm focus:outline-none"
                       style="background-color: var(--md-surface-2); color: var(--md-text); border: 1px solid var(--md-surface-border)"
                       required>
                @error('password')
                    <x-error :message="$message"></x-error>
                @enderror
            </div>

            <button type="submit"
                    class="w-full font-semibold py-2.5 rounded-full text-sm mt-2 transition-transform duration-150 active:scale-95"
                    style="background-color: var(--md-primary); color: var(--md-on-primary)">
                Create Account
            </button>

            <p class="text-center text-xs pt-1" style="color: var(--md-text-dim)">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold" style="color: var(--md-primary)">Sign in</a>
            </p>
        </form>
    </div>
</x-layout>
