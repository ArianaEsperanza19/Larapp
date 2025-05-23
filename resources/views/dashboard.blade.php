<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @vite('resources/css/styles.css')
    @include('includes.avatar')
    <x-box-layout>
        <div>Usuario: {{ Auth::user()->name }} {{ Auth::user()->surname }}</div>
        <div>Email: {{ Auth::user()->email }}</div>
        <div>Se unió: {{ Auth::user()->created_at->diffForHumans() }}</div>
    </x-box-layout>
</x-app-layout>
