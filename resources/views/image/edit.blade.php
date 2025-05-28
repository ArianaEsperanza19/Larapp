<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SocialDash') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <link rel="stylesheet" href="resources/css/styles.css"> -->
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <!-- Page Heading -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Editar') }}
                </h2>
            </div>
        </header>

        <x-guest-layout>
            <form id="send-verification" method="post" action="{{ route('verification.send') }}"
                enctype="multipart/form-data">
                @csrf
            </form>

            <form method="post" action="{{ route('img.edit', ['id_img' => $image->id]) }}" class="mt-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div style="width: 70%; align-items: center">
                    <div>
                        <input type="hidden" name="id" value="{{ $image->id }}"\>
                        <x-input-label for="descripcion" :value="__('Descripción')" />
                        <textarea id="descripcion" name="descripcion" type="text" class="mt-1 block w-full" required autofocus
                            autocomplete="descripcion" />{{ $image->description }}</textarea>

                        <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
                    </div>
                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        <img src="{{ route('img.miniatura', ['fileName' => $image->image_path]) }}"
                            class="rounded-circle img-thumbnail me-3 mt-1" width="200">
                        <x-text-input id="image" name="image" type="file" class="mt-1 block w-full"
                            :value="old('image', $image->image_path)" required autofocus autocomplete="image" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>

                    <br>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    </div>
                    @endif
                </div>
            </form>
        </x-guest-layout>
    </div>
</body>

</html>
