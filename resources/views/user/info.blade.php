<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    @vite('resources/css/styles.css')
    <x-profile-layout>
        <div>Usuario: {{ $user->name }} {{ $user->surname }}</div>
        <div>Email: {{ $user->email }}</div>
        <div>Se unió: {{ $user->created_at->diffForHumans() }}</div>
    </x-profile-layout>
</x-app-layout>
