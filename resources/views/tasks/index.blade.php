@props([
    'tasks'
])
<x-layout title="Tasks">
    <div class="w-full flex flex-col mx-auto justify-between p-10 rounded-xl mt-10">
        <a href="{{ route('tasks.create') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-bold px-10 py-5 rounded-xl mx-auto mb-6">
            Create Task
        </a>
        @if(count($tasks) > 0)
            <div class="grid grid-cols-4 gap-4">
                @foreach($tasks as $task)
                    <x-task-card
                        :task="$task"

                    />
                @endforeach
            </div>
        @else
            <p class="text-white mt-2">No tasks available</p>
        @endif
    </div>
</x-layout>
