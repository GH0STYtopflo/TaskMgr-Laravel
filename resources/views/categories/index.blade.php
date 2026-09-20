@props([
    'categories' => []
])

<x-layout title="Categories">
    <div class="max-w-1/3 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
         style="background-color: #08032a">
        <div class="mx-auto mb-10">
            <h2 class="text-white font-bold text-3xl">
                Create a new task category
            </h2>
        </div>

        <form action="/categories" method="POST">
            @csrf

            <input type="text" name="title" placeholder="title"
                   class="bg-white p-2 rounded mb-5 w-full" required>
            @error('title')
            <x-error :message="$message"></x-error>
            @enderror
            <input type="submit"
                   value="Create"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold">
        </form>
    </div>

    <div class="w-full mt-10 flex flex-col">
        <h1 class="mx-auto text-white font-bold text-2xl mb-5 max-w-1/3">Existing Categories</h1>
        <ul class="mx-auto space-y-2 max-w-1/3">
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <x-card :title="$category->title" :id="$category->id"></x-card>
                @endforeach
            @else
                <p class="text-white"> No categories found. Start by creating one </p>
            @endif
        </ul>
    </div>
</x-layout>
