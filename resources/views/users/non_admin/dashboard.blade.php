<x-layout title="User Dashboard">
    <div class="w-full flex flex-col mx-auto justify-between p-10 rounded-xl mt-10">
        <label class="text-3xl text-white mx-auto mb-10 font-bold">Your tasks</label>
        @if(count($tasks) > 0)
            <div class="grid grid-cols-5 gap-4">
                @foreach($tasks as $task)
                    <x-task-card
                        :title="$task->title"
                        :id="$task->id"
                        :description="$task->description"
                        :status="$task->status"
                        :date="(new DateTimeImmutable($task->deadline))->format('Y-m-d H:i:s')"
                        non-admin="1"
                    />
                @endforeach
            </div>
        @else
            <p class="text-white mt-2">No tasks available</p>
        @endif
    </div>
</x-layout>
