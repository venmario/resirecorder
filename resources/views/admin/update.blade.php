{{-- @extends('layouts.index')

@section('content')
<div class="container vh-100 d-flex align-items-center">
    <div class=" w-50 mx-auto border rounded shadow-sm">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <p>{{ $user->username }}</p>
</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
</div>
</div>
@endsection --}}

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        @if (Session::has('success'))
        <div class="mb-4">
            <p class="text-green-600">{{ Session::get('success') }}</p>

        </div>
        @endif
        <div class="mt-4">
            <x-label for="username" :value="__('Edit pegawai')" />

        </div>
        <form method="POST" action="{{ route('admin.update',$user->username) }}">
            @csrf
            @method('PUT')
            <div class="mt-4">
                <x-label for="nama" :value="__('Nama')" />

                <input
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                    id="nama" type="text" name="nama" value="{{ $user->nama }}" required>
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.index') }}">
                    {{ __('Kembali') }}
                </a>
                <x-button class="ml-4">
                    {{ __('Ubah') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
