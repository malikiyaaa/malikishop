<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>@yield('title', 'Toko Komputer')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class='bg-gray-50'>
    <nav class='bg-white shadow'>
        <div class='max-w-7xl mx-auto px-4 py-4 flex flex-wrap justify-between gap-3'>
            <h1 class='text-2xl font-bold text-blue-600'>Toko Komputer</h1>
            <div class='flex flex-wrap gap-4 items-center'>
                @auth
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <a href='{{ route('riwayatpesanan') }}' class='text-blue-600 hover:underline'>Riwayat Pesanan</a>
                    @if(Auth::user()->role === 'admin')
                        <a href='/admin' class='text-blue-600'>Admin Panel</a>
                    @endif
                    <form method='POST' action='{{ route('logout') }}'>
                        @csrf
                        <button class='text-red-600'>Logout</button>
                    </form>
                @endauth
                @guest
                    <a href='{{ route('login') }}' class='text-blue-600'>Login</a>
                    <a href='{{ route('register') }}' class='text-blue-600'>Register</a>
                @endguest
            </div>
        </div>
    </nav>
    <main class='max-w-7xl mx-auto px-4 py-8'>
        @if(session('success'))
            <div class='bg-green-100 text-green-700 px-4 py-3 rounded mb-4'>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class='bg-red-100 text-red-700 px-4 py-3 rounded mb-4'>
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
