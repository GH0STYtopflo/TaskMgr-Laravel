@props([
    'title',
    'description',
    'status',
    'id',
    'date',
    'nonAdmin'
])

<a href="{{ $nonAdmin ? '/users/' . Auth::user()->id . '/tasks/' . $id : '/tasks/' . $id }}">
    <div class="flex items-center justify-between rounded-xl p-5 w-full cursor-pointer mb-3"
         style="background-color: #08032a">

        <div class="space-y-1">
            <p class="text-white font-bold">
                {{$title}}
            </p>

            <p class="text-white text-sm truncate">
                {{$description}}
            </p>

            <p class="text-white mt-5 text-xs">
                Deadline: {{$date}}
            </p>
        </div>

        <div class="ml-6 px-4 py-3 rounded-2xl text-xs font-bold bg-purple-500 text-white shrink-0">
            {{$status}}
        </div>
    </div>
</a>
