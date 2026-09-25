@props([
    'tasks'
])
<x-layout title="Tasks">
    <div class="w-full flex flex-col mx-auto justify-between p-10 rounded-xl mt-10">
        @if(count($tasks) > 0)
            <div class="grid grid-cols-4 gap-4">
                @foreach($tasks as $task)
                    <x-task-card
                        :title="$task->title"
                        :id="$task->id"
                        :description="$task->description"
                        :status="$task->status"
                        :date="(new DateTimeImmutable($task->deadline))->format('Y-m-d H:i:s')"
                        non-admin="0"
                    />
                @endforeach
            </div>
        @else
            <p class="text-white mt-2">No tasks available</p>
        @endif
    </div>
</x-layout>
