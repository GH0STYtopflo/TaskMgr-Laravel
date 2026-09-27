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
    @vite('resources/css/app.css')
    <title>TaskMgr</title>
    <style>
        :root {
            --md-bg: #0f0a1a;
            --md-surface: #1a1428;
            --md-surface-1: #201933;
            --md-surface-2: #251d3a;
            --md-surface-border: #322a47;
            --md-primary: #b388ff;
            --md-primary-container: #4a2f7a;
            --md-on-primary: #1a0a3d;
            --md-text: #e9e3f5;
            --md-text-dim: #a89dc2;
            --md-error: #ffb4ab;
            --md-error-container: #4a1515;
        }

        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            background-color: var(--md-bg);
            color: var(--md-text);
        }

        header {
            background-color: var(--md-surface-1);
            border: 1px solid var(--md-surface-border);
        }
    </style>
</head>
<body class="w-full flex flex-col">
<header class="mt-4 w-11/12 lg:w-3/4 mx-auto h-16 flex items-center justify-between rounded-2xl px-5">
    <a href="{{ Auth::guest() ? '/' : route('users.dashboard', Auth::user()) }}"
       class="font-semibold text-xl tracking-tight" style="color: var(--md-text)">
        {{ $title }}
    </a>

    <div class="flex gap-2">
        @guest()
            <a href="{{ route('signup') }}">
                <button
                    class="text-sm font-medium px-4 py-2 rounded-full transition-colors duration-150 active:scale-95 cursor-pointer"
                    style="color: var(--md-primary); background-color: transparent;"
                    onmouseover="this.style.backgroundColor='var(--md-surface-2)'"
                    onmouseout="this.style.backgroundColor='transparent'">
                    Signup
                </button>
            </a>
            <a href="{{ route('login') }}">
                <button
                    class="text-sm font-medium px-4 py-2 rounded-full transition-colors duration-150 active:scale-95 cursor-pointer"
                    style="background-color: var(--md-primary); color: var(--md-on-primary);">
                    Login
                </button>
            </a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @method('DELETE')
                <button
                    class="text-sm font-medium px-4 py-2 rounded-full transition-colors duration-150 active:scale-95 cursor-pointer"
                    style="color: var(--md-text-dim); background-color: transparent;"
                    onmouseover="this.style.backgroundColor='var(--md-surface-2)'"
                    onmouseout="this.style.backgroundColor='transparent'">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</header>

<section class="w-full min-h-screen flex flex-col py-6 px-4">
    {{ $slot }}
</section>
</body>
</html>
