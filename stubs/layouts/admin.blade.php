<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Panel' }} — {{ config('livewire-admin.brand_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-[#eef2f6] font-sans text-slate-800 antialiased">
@auth
@php
    // TODO: customize navigation for your app
    $nav = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'match' => 'admin.dashboard'],
    ];
    $isActive = fn ($match) => request()->routeIs($match);
@endphp
<div x-data="{ open: false }" class="min-h-screen lg:flex">
    {{-- Sidebar + header: customize or copy from caganmekanik.com/resources/views/layouts/admin.blade.php --}}
    <main class="flex-1 p-4 lg:p-8">
        <div class="mx-auto max-w-7xl">
            {{ $slot }}
        </div>
    </main>
</div>
@else
    <main class="flex min-h-screen items-center justify-center p-4">
        {{ $slot }}
    </main>
@endauth

@auth
    @if (class_exists(\EnesEkinci\Media\Livewire\MediaPicker::class))
        <livewire:media-picker />
    @endif
    <livewire:flash-toast />
    <livewire:confirm-modal />
@endauth

@livewireScripts
</body>
</html>
