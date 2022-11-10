<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 sm:rounded-lg">
                    <img src="{{ asset('logo/logo.png') }}" class="" alt="">
                </div>
            </a>
        </x-slot>
        @if (Session::has('success'))
        <div class="mb-4">
            <p class="text-green-600">{{ Session::get('success') }}</p>
            <a class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 "
                href="{{ route('dashboard') }}">
                {{ __('Kembali ke dashboard') }}
            </a>
        </div>
        @else
        <form method="POST" action="{{ route('merchant.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="nama" :value="__('Nama')" />

                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('dashboard') }}">
                    {{ __('Kembali ke dashboard') }}
                </a>
                <x-button class="ml-4">
                    {{ __('Tambah') }}
                </x-button>
            </div>
        </form>
        @endif

    </x-auth-card>
</x-guest-layout>
