@props([
    'task',
])

<x-layout title="Edit Task">

    <div class="w-1/2 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
         style="background-color: #08032a">
        <div class="mx-auto mb-10">
            <h2 class="text-white font-bold text-3xl">
                {{$task->title}}
            </h2>
        </div>

        <form action="/users/{{Auth::user()->id}}/tasks/{{$task->id}}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-5">
                <label class="w-full text-white font-bold">Title: </label>
                <label class="w-full text-white">{{$task->title}}</label>
            </div>

            <div class="mb-5">
                <label class="w-full text-white font-bold">Description: </label>
                <label class="w-full text-white">{{$task->description}}</label>
            </div>

            <div class="mb-5">
                <label class="w-full text-white font-bold">Priority: </label>
                <label class="w-full text-white">{{$task->priority}}</label>
            </div>


            <div class="w-full flex justify-between space-x-2 mb-5">
                <div class="flex flex-col w-full">
                    <label class="text-white font-bold mb-2"> Categories</label>
                    <ul>
                        @foreach($task->categories as $category)
                            <li class="text-white">{{$category->title}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex flex-col w-full">
                    <label class="text-white font-bold"> Users </label>
                    <ul>
                        @foreach($task->users as $user)
                            <li class="text-white">{{$user->username}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mb-5">
                <label class="w-full text-white font-bold">Deadline: </label>
                <label class="w-full text-white">{{(new DateTimeImmutable($task->deadline))->format('Y-m-d H:i:s')}}</label>
            </div>

            <div class="flex justify-center space-x-4 w-full">
                <label class="text-white">Set Finished</label>
                <input type="checkbox" class="scale-150" name="task_is_done" @if($task->status == 'COMPLETED') checked @endif>
            </div>
            @error('finished')
            <x-error :message="$message"></x-error>
            @enderror

            <input type="submit"
                   value="Submit changes"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold mt-5">
        </form>

        <label class="text-white font-bold mt-15"> Subtasks </label>
        @foreach($task->subtasks as $subtask)
            <div class="flex justify-between items-center space-x-1">
                <form action="{{ route('tasks.subtasks.status', [Auth::user(), $task, $subtask]) }}" method="post" class="w-full flex justify-between items-center mb-5">
                    @csrf
                    @method('PATCH')

                    <label class="text-white w-full">{{$subtask->title}}</label>

                    <div class="flex justify-center space-x-4 w-1/3">
                        <label class="text-white">Completed</label>
                        <input type="checkbox" class="scale-150" name="is_done" @if($subtask->is_completed) checked @endif>
                    </div>

                    <button type="submit" class="bg-pink-500 p-2 cursor-pointer transition duration-200 hover:scale-105 rounded font-bold">
                        Update
                    </button>
                </form>
            </div>
        @endforeach
        @error('subtasks')
        <x-error :message="$message"></x-error>
        @enderror
    </div>

    <div class="w-1/2 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
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
