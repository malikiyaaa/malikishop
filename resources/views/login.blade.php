@extends('layouts.app')

@section('title', 'Login - Toko Komputer')

@section('content')
<div class='max-w-md mx-auto bg-white p-8 rounded-lg shadow'>
    <h2 class='text-2xl font-bold mb-6 text-center'>Login</h2>

    @if($errors->any())
        <div class='bg-red-100 text-red-700 px-4 py-3 rounded mb-4'>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action='{{ route('actionlogin') }}' method='POST'>
        @csrf
        <div class='mb-4'>
            <label class='block font-bold mb-1'>Email</label>
            <input type='email' name='email' value='{{ old('email') }}'
                   class='w-full border rounded px-4 py-2' required>
        </div>
        <div class='mb-6'>
            <label class='block font-bold mb-1'>Password</label>
            <input type='password' name='password'
                   class='w-full border rounded px-4 py-2' required>
        </div>
        <label class='flex items-center gap-2 mb-6 text-sm'>
            <input type='checkbox' name='remember' value='1'> Ingat saya
        </label>
        <button type='submit'
            class='w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700'>
            Login
        </button>
    </form>

    <p class='text-center text-sm mt-4 text-gray-600'>
        Belum punya akun?
        <a href='{{ route('register') }}' class='text-blue-600'>Daftar di sini</a>
    </p>
</div>
@endsection
