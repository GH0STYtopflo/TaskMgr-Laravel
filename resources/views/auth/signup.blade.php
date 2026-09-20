<x-layout title="Signup">
    <div class="max-w-3xl m-auto p-10 rounded-xl flex flex-col" style="background-color: #08032a;">
        <div class="mx-auto mb-15">
            <h2 class="text-white font-bold text-4xl">
                Signup
            </h2>
        </div>
        <form action="/signup" method="POST" class="px-10 w-130 flex flex-col space-y-5">
            @csrf

            <input type="text" name="username" placeholder="username"
                   class="bg-white p-2 rounded" required>
            @error('username')
            <x-error :message="$message"></x-error>
            @enderror
            <input type="password" name="password" placeholder="password"
                   class="bg-white p-2 rounded" required>
            @error('password')
            <x-error :message="$message"></x-error>
            @enderror
            <input type="email" name="email" placeholder="email"
                   class="bg-white p-2 rounded">
            @error('email')
            <x-error :message="$message"></x-error>
            @enderror
            <input type="submit"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl">
        </form>
    </div>
</x-layout>
