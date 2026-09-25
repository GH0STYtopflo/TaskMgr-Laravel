<x-layout title="User">

    <div class="w-1/2 flex flex-col mx-auto justify-between p-10 rounded-xl mt-10"
         style="background-color: #08032a">
        <div class="mx-auto mb-10 w-full flex flex-col">
            <div class="w-full flex justify-center mb-5">
                <h2 class="text-white font-bold text-3xl">
                    User
                </h2>
            </div>

            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <input type="text" class="bg-white rounded p-2 w-full" required readonly placeholder="Id: {{$user->id}}">
                    </div>

                    <div>
                        <input type="text" name="username" class="bg-white rounded p-2 w-full" required placeholder="username" value="{{$user->username}}">
                    </div>
                    @error('username')
                        <x-error :message="$message"></x-error>
                    @enderror

                    <div>
                        <input type="text" name="email" class="bg-white rounded p-2 w-full" required  placeholder="email" value="{{$user->email}}">
                    </div>
                    @error('email')
                    <x-error :message="$message"></x-error>
                    @enderror
                </div>

                <div class="mt-5">
                    <label class="text-white font-bold">New Password</label>
                    <input type="password" name="new_password" class="bg-white rounded p-2 w-full mt-3" placeholder="new password">
                </div>
                @error('new_password')
                <x-error :message="$message"></x-error>
                @enderror

                <input type="submit"
                       value="Update"
                       class="bg-pink-500 w-full p-2 cursor-pointer transition duration-200 hover:scale-105 rounded-xl font-bold mt-5">
            </form>

            <hr class="mt-5">

            <div class="mt-5 mb-5">
                <label class="text-white font-bold mb-5">Tasks</label>
                @if(count($user->tasks) > 0)
                    <div class="grid grid-cols-2 space-x-2 gap-2">
                        @foreach($user->tasks as $task)
                            <a href="{{"/tasks/$task->id"}}" class="mt-5 bg-blue-900 rounded flex justify-between p-4 w-full">
                                <div>
                                    <div>
                                        <label class="text-white font-bold">Task:</label>
                                        <label class="text-white">{{$task->title}}</label>
                                    </div>

                                    <div>
                                        <label class="text-white font-bold">Task Id:</label>
                                        <label class="text-white">{{$task->id}}</label>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-white">User is not currently assigned to any tasks</p>
                @endif
            </div>
        </div>

    </div>

</x-layout>
