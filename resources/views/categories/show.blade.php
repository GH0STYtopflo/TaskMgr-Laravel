@props(['category'])

<x-layout title="Edit Category">
    <div class="max-w-1/3 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
         style="background-color: #08032a">
        <div class="mx-auto mb-10">
            <h2 class="text-white font-bold text-3xl">
                Edit Task
            </h2>
        </div>

        <form action="/categories/{{$category->id}}" method="POST">
            @csrf
            @method('PATCH')

            <input type="text" name="title" placeholder="title"
                   class="bg-white p-2 rounded mb-5 w-full" required value={{$category->title}}>
            @error('title')
            <x-error :message="$message"></x-error>
            @enderror
            <input type="submit"
                   value="Update"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold">
        </form>

        <form action="/categories/{{$category->id}}" method="post">
            @csrf
            @method('DELETE')

            <input type="submit"
                   value="Delete"
                   class="bg-red-900 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold mt-10">
        </form>
    </div>

</x-layout>
