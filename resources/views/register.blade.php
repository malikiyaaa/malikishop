@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
<div class='max-w-md mx-auto bg-white p-8 rounded-lg shadow'>
    <h2 class='text-2xl font-bold mb-6 text-center'>Registrasi</h2>

    @if($errors->any())
        <div class='bg-red-100 text-red-700 px-4 py-3 rounded mb-4'>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action='{{ route('actionregister') }}' method='POST'>
        @csrf
        <div class='mb-4'>
            <label class='block font-bold mb-1'>Nama</label>
            <input type='text' name='name' class='w-full border rounded px-4 py-2' required>
        </div>
        <div class='mb-4'>
            <label class='block font-bold mb-1'>Email</label>
            <input type='email' name='email' class='w-full border rounded px-4 py-2' required>
        </div>
        <div class='mb-4'>
            <label class='block font-bold mb-1'>Password</label>
            <input type='password' name='password' class='w-full border rounded px-4 py-2' required>
        </div>
        <div class='mb-6'>
            <label class='block font-bold mb-1'>Konfirmasi Password</label>
            <input type='password' name='password_confirmation'
                   class='w-full border rounded px-4 py-2' required>
        </div>
        <button type='submit'
            class='w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700'>
            Daftar Sekarang
        </button>
    </form>

    <p class='text-center text-sm mt-4 text-gray-600'>
        Sudah punya akun?
        <a href='{{ route('login') }}' class='text-blue-600'>Login di sini</a>
    </p>
</div>
@endsection
