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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @vite('resources/css/dashboard.css')
    <div class="info-profile-box">
        <div>
            <div class="big-avatar">@include('includes.avatar2')</div>
            <div class="info-container">
                <div class="User">{{ Auth::user()->name }} {{ Auth::user()->surname }}</div>
                @if (Auth::user()->nickname != null)
                    <div class="nickname"><?php echo '@'; ?>{{ Auth::user()->nickname }} </div>
                @endif
                <div>Se unió: {{ Auth::user()->created_at->diffForHumans() }}</div>
            </div>
        </div>
    </div>
    @include('image.misPosts')
</x-app-layout>
