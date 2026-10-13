<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Blog') | Blog CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-indigo-600 text-white p-4 flex justify-between items-center">
        <a href="{{ route('posts.index') }}" class="font-bold">Blog</a>
        <div class="flex items-center gap-4">
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.index') }}">Admin</a>
                @endif
                <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button>Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-3xl mx-auto p-6">
        @if (session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif
        @if (session('error'))
            <x-alert type="error">{{ session('error') }}</x-alert>
        @endif
        @if ($errors->any())
            <x-alert type="error">Periksa kembali isian Anda.</x-alert>
        @endif

        @yield('content')
    </main>
</body>
</html>