@props([
    'title' => 'NA',
    'id' => '-1',
])

<a href="/categories/{{$id}}">
    <div class="flex rounded p-4 pl-50 pr-50 w-full cursor-pointer mb-2" style="background-color: #08032a">
        <p class="text-white font-bold">{{$title}}</p>
    </div>
</a>
