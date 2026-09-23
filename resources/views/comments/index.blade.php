<x-layout title="Comments">
    <div class="max-w-1/3 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
         style="background-color: #08032a">
        <div class="mx-auto mb-10">
            <h2 class="text-white font-bold text-3xl">
                Create a new task
            </h2>
        </div>

        <form action="/comments" method="GET">
            @csrf

            <input type="text" name="keyword" placeholder="keyword"
                   class="bg-white p-2 rounded mb-5 w-full">

            <div class="flex justify-between space-x-1">
                <input type="number" name="task_id" class="w-full p-2 rounded bg-white mb-5" placeholder="task id">
                <input type="text" name="username" class="w-full p-2 rounded bg-white mb-5" placeholder="username">
            </div>

            <div class="flex justify-between space-x-1">
                <div class="flex flex-col">
                    <label class="text-white font-bold">Before</label>
                    <input type="datetime-local" name="before" class="w-full bg-white p-2 mb-5 rounded">
                </div>

                <div class="flex flex-col">
                    <label class="text-white font-bold">After</label>
                    <input type="datetime-local" name="after" class="w-full bg-white p-2 mb-5 rounded">
                </div>
            </div>

            <input type="submit"
                   value="Lookup"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold mt-5">
        </form>
    </div>

    <div class="space-y-2 w-1/3 mt-5 mb-5 mx-auto">
        @if(count($comments) > 0)
            @foreach($comments as $comment)
                <x-comment-card :comment="$comment"></x-comment-card>
            @endforeach
        @else
            <p class="text-white">No results found</p>
        @endif
    </div>
</x-layout>
