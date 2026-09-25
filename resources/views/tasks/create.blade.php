@props([
    'categories',
    'users'
])

<x-layout title="Create Task">
    <div class="max-w-1/3 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
         style="background-color: #08032a">
        <div class="mx-auto mb-10">
            <h2 class="text-white font-bold text-3xl">
                Create a new task
            </h2>
        </div>

        <form action="/tasks" method="POST">
            @csrf

            <input type="text" name="title" placeholder="title"
                   class="bg-white p-2 rounded mb-5 w-full" required>
            @error('title')
            <x-error :message="$message"></x-error>
            @enderror

            <textarea class="bg-white w-full p-2 rounded mb-5" placeholder="Description" name="description"
                      rows="5"></textarea>
            @error('description')
            <x-error :message="$message"></x-error>
            @enderror

            <input type="number" name="priority" class="w-full p-2 rounded bg-white mb-5" placeholder="priority"
                   required>
            @error('priority')
            <x-error :message="$message"></x-error>
            @enderror

            <div class="w-full flex justify-between space-x-2 mb-5">
                <div class="flex flex-col w-full">
                    <h3 class="text-white font-bold"> Categories To Assign</h3>
                    <select name="categories[]" class="w-full bg-white rounded p-2" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->title}}
                            </option>
                        @endforeach
                    </select>
                    @error('categories[]')
                    <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div class="flex flex-col w-full">
                    <h3 class="text-white font-bold"> Users To Assign</h3>
                    <select name="users[]" class="w-full bg-white rounded p-2" multiple>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">
                                {{$user->username}}
                            </option>
                        @endforeach
                    </select>
                    @error('users[]')
                    <x-error :message="$message"></x-error>
                    @enderror
                </div>
            </div>

            <input type="datetime-local" name="deadline" class="w-full bg-white p-2 mb-5 rounded" min="{{ now()->format('Y-m-d\TH:i')}}" required>
            @error('deadline')
            <x-error :message="$message"></x-error>
            @enderror

            <textarea class="bg-white w-full p-2 rounded mb-5" placeholder="Subtasks (separated by newlines)"
                      name="subtasks" rows="5"></textarea>
            @error('subtasks')
            <x-error :message="$message"></x-error>
            @enderror

            <input type="submit"
                   value="Create"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold mt-5">
            @error('task')
                <x-error :message="$message"></x-error>
            @enderror
        </form>
    </div>
</x-layout>
