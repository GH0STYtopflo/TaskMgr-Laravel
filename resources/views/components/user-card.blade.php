<div class="w-full p-4 rounded-xl flex flex-col" style="background-color: #8d0c97">
    <a href="{{"/users/$user->id"}}" class="space-y-5">
        <div class="w-full flex justify-center space-x-1">
            <label class="text-white font-bold">Id:</label>
            <label class="text-white">{{$user->id}}</label>
        </div>
        <hr>
        <div class="flex justify-between w-full">
            <div class="w-full">
                <label class="text-white font-bold">Username:</label>
                <label class="text-white">{{$user->username}}</label>
            </div>
            <div class="w-full">
                <label class="text-white font-bold">Joined at:</label>
                <label class="text-white">{{$user->created_at}}</label>
            </div>
        </div>
    </a>
</div>
