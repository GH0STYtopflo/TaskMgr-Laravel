@props([
    'task'
])

<x-layout title="Edit Task">

    <div class="w-1/2 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
         style="background-color: #08032a">
        <div class="mx-auto mb-10">
            <h2 class="text-white font-bold text-3xl">
                Edit Task
            </h2>
        </div>

        <form action="/tasks/{{$task->id}}" method="POST">
            @csrf
            @method('PATCH')

            <input type="text" name="title" placeholder="title"
                   class="bg-white p-2 rounded mb-5 w-full"
                   required
                   value={{$task->title}}
            >
            @error('title')
            <x-error :message="$message"></x-error>
            @enderror

            <textarea class="bg-white w-full p-2 rounded mb-5" placeholder="Description" name="description"
                      rows="5"> {{$task->description}} </textarea>
            @error('description')
            <x-error :message="$message"></x-error>
            @enderror

            <input type="number" name="priority" class="w-full p-2 rounded bg-white mb-5" placeholder="priority"
                   required value={{$task->priority}}>
            @error('priority')
            <x-error :message="$message"></x-error>
            @enderror

            <div class="w-full flex justify-between space-x-2 mb-5">
                <div class="flex flex-col w-full">
                    <label class="text-white font-bold"> Categories To Assign</label>
                    <select name="categories[]" class="w-full bg-white rounded p-2" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if($task->categories->contains($category)) selected @endif>
                                {{$category->title}}
                            </option>
                        @endforeach
                    </select>
                    @error('categories[]')
                    <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div class="flex flex-col w-full">
                    <label class="text-white font-bold"> Users To Assign</label>
                    <select name="users[]" class="w-full bg-white rounded p-2" multiple>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if($task->users->contains($user)) selected @endif>
                                {{$user->username}}
                            </option>
                        @endforeach
                    </select>
                    @error('users[]')
                    <x-error :message="$message"></x-error>
                    @enderror
                </div>
            </div>

            <input type="datetime-local" name="deadline" class="w-full bg-white p-2 mb-5 rounded" required
                   value={{$task->deadline}}>
            @error('deadline')
            <x-error :message="$message"></x-error>
            @enderror

            <textarea class="bg-white w-full p-2 rounded mb-5" placeholder="New Subtasks (separated by newlines)"
                      name="subtasks" rows="5"></textarea>

            <div class="flex justify-center space-x-4 w-full">
                <label class="text-white">Set Finished</label>
                <input type="checkbox" class="scale-150" name="taskIsDone" @if($task->status == 'COMPLETED') checked @endif>
            </div>
            @error('finished')
            <x-error :message="$message"></x-error>
            @enderror

            <input type="submit"
                   value="Edit"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold mt-5">
            @error('update')
                <x-error :message="$message"></x-error>
            @enderror
        </form>

        <form action="/tasks/{{$task->id}}" method="POST">
            @csrf
            @method('DELETE')

            <input type="submit"
                   value="Delete"
                   class="bg-red-900 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold mt-5">
        </form>

        <label class="text-white font-bold mt-15"> Subtasks </label>
        @foreach($task->subtasks as $subtask)
            <div class="flex justify-between items-center space-x-1">
                <form action="{{ route('tasks.subtasks.update', [$task, $subtask]) }}" method="post" class="w-full flex justify-between items-center mb-5">
                    @csrf
                    @method('PATCH')

                    <input type="text" name="title" placeholder="subtask"
                           class="bg-white p-2 rounded w-full"
                           required
                           value="{{$subtask->title}}"
                    >

                    <div class="flex justify-center space-x-4 w-1/3">
                        <label class="text-white">Completed</label>
                        <input type="checkbox" class="scale-150" name="is_done" @if($subtask->is_completed) checked @endif>
                    </div>

                    <button type="submit" class="bg-pink-500 p-2 cursor-pointer transition duration-200 hover:scale-105 rounded font-bold">
                        Update
                    </button>
                </form>

                <form action="{{ route('tasks.subtasks.destroy', [$task, $subtask]) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="bg-red-900 p-2 cursor-pointer transition duration-200 hover:scale-105 rounded font-bold mb-5">
                        Delete
                    </button>
                </form>
            </div>
        @endforeach
        @error('subtasks')
        <x-error :message="$message"></x-error>
        @enderror
    </div>

    <div class="w-1/2 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10 mb-5"
         style="background-color: #08032a">
        <div class="mx-auto mb-10">
            <h2 class="text-white font-bold text-3xl">
                Comment
            </h2>
        </div>

        <form action="{{"/tasks/" . $task->id . "/comments"}}" method="POST">
            @csrf

            <input type="text" name="body" placeholder="comment"
                   class="bg-white p-2 rounded mb-5 w-full">
            @error('title')
            <x-error :message="$message"></x-error>
            @enderror
            <input type="submit"
                   value="Comment"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold">
        </form>

        <div class="space-y-2 w-full mt-5">
            <div class="mb-10">
                <label class="text-white text-2xl font-bold">Comments</label>
            </div>
            @if(count($comments) > 0)
                @foreach($comments as $comment)
                    <x-comment-card :comment="$comment"></x-comment-card>
                @endforeach
            @else
                <p class="text-white">No Comments for this task</p>
            @endif
        </div>

    </div>

</x-layout>
