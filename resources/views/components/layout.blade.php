@props([
    'title' => ''
])

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>TaskMgr</title>
</head>
<body style="background-color: #070012" class="w-full flex flex-col">
<header style="background-color: #8f00e1"
        class="mt-3 w-1/2 mx-auto h-13 flex items-center justify-between rounded-md pr-5 pl-5 space-x-1">

    <div>
        <a href="{{ Auth::guest() ? '/' : route('users.dashboard', Auth::user()) }}">
            <button class="font-sarif font-extrabold text-2xl cursor-pointer">
                {{$title}}
            </button>
        </a>
    </div>

    <div>
        @guest()
            <a href="/signup{{ route('signup') }}">
                <button
                    class="font-bold bg-pink-950 p-2 pl-3 pr-3 rounded-2xl text-amber-50 transition duration-200 hover:scale-105 cursor-pointer">
                    Signup
                </button>
            </a>
            <a href="{{ route('login') }}">
                <button
                    class="font-bold bg-emerald-950 p-2 pl-3 pr-3 rounded-2xl text-amber-50 transition duration-200 hover:scale-105 cursor-pointer">
                    Login
                </button>
            </a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @method('DELETE')
                <button
                    class="font-bold bg-red-900 p-2 pl-3 pr-3 rounded-2xl text-amber-50 transition duration-200 hover:scale-105 cursor-pointer">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</header>
<section class="w-full min-h-screen flex flex-col">
    {{$slot}}
</section>
</body>
</html>
