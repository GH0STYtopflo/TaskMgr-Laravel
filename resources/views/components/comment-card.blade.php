<div class="w-full p-4 rounded-xl flex flex-col" style="background-color: #8d0c97">
    <div class="w-full flex justify-between">
        <label class="text-white font-bold">{{$comment->user->username}}</label>
        <div>
            <label class="text-white font-bold">Time: </label>
            <label class="text-white">{{(new DateTimeImmutable($comment->created_at))->format('Y-m-d H:i:s')}}</label>
        </div>
    </div>
    <hr class="mt-3">
    <form method="POST" action={{"/tasks/" . $comment->task->id . "/comments/" . $comment->id}}>
        <textarea name="body" class="w-full mt-2 text-white" rows="5" {{$comment->user->is(Auth::user()) ? "" : "readonly"}}>{{$comment->body}}</textarea>

        @if($comment->user->is(Auth::user()))
            @csrf
            @method('PATCH')
            <input type="submit"
                   value="Edit"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold">
        @endif
    </form>

    @if($comment->user->is(Auth::user()))
        <form class="mt-3" method="POST" action={{"/tasks/" . $comment->task->id . "/comments/" . $comment->id}}>
            @csrf
            @method('DELETE')

            <input type="submit"
                   value="Delete"
                   class="bg-red-900 w-full p-2 cursor-pointer transition rounded-xl font-bold">
        </form>
    @endif


</div>
