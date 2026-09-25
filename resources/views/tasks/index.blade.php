@props([
    'tasks'
])

<x-layout title="Tasks">
    <div class="max-w-1/3 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
         style="background-color: #08032a">
        <div class="mx-auto mb-10">
            <h2 class="text-white font-bold text-3xl">
                Query Tasks
            </h2>
        </div>

        <form action="{{ route('tasks.index') }}" method="GET">
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="text-white">Priority less than</label>
                    <input type="number" name="plt"
                           class="bg-white p-2 rounded mb-5 w-full">
                </div>

                <div>
                    <label class="text-white">Priority greater than</label>
                    <input type="number" name="pgt"
                           class="bg-white p-2 rounded mb-5 w-full">
                </div>

                <div>
                    <label class="text-white">Created before</label>
                    <input type="datetime-local" name="created_before"
                           class="w-full bg-white p-2 mb-5 rounded">
                </div>

                <div>
                    <label class="text-white">Created after</label>
                    <input type="datetime-local" name="created_after"
                           class="w-full bg-white p-2 mb-5 rounded">
                </div>

                <div>
                    <label class="text-white">Deadline before</label>
                    <input type="datetime-local" name="deadline_before"
                           class="w-full bg-white p-2 mb-5 rounded">
                </div>

                <div>
                    <label class="text-white">Deadline after</label>
                    <input type="datetime-local" name="deadline_after"
                           class="w-full bg-white p-2 mb-5 rounded">
                </div>

                <div>
                    <label class="text-white">Status</label>
                    <select name="status" class="w-full bg-white rounded p-2 mb-5">
                        <option value="">Any status</option>
                        <option value="ONGOING">Ongoing</option>
                        <option value="COMPLETED">Completed</option>
                    </select>
                </div>

                <div>
                    <label class="text-white">Order by</label>
                    <select name="order_by" class="w-full bg-white rounded p-2 mb-5">
                        <option value="created_at">Created at</option>
                        <option value="updated_at">Updated at</option>
                        <option value="status">Status</option>
                        <option value="deadline">Deadline</option>
                    </select>
                </div>
            </div>

            <input type="submit"
                   value="Query"
                   class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold mt-5">
        </form>
    </div>

    @if(count($tasks) > 0)
        <div class="grid grid-cols-4 gap-4 mt-10 p-2">
            @foreach($tasks as $task)
                <x-task-card
                    :task="$task"
                />
            @endforeach
        </div>
    @else
        <p class="text-white mt-2">No tasks available</p>
    @endif
</x-layout>
