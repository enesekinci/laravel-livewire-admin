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
    $brand = config('livewire-admin.brand_color', '#16a34a');
    $brandShort = config('livewire-admin.brand_short', 'ST');

    $homeIcon = 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z';
    $cogIcon = 'M12 15a3 3 0 100-6 3 3 0 000 6z M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z';

    $nav = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'icon' => $homeIcon],
        ['label' => 'Ayarlar', 'route' => 'admin.settings.index', 'match' => 'admin.settings.*', 'icon' => $cogIcon],
    ];
@endphp
<div x-data="{ open: false }" class="min-h-screen lg:flex">
    <div
        x-show="open"
        x-cloak
        x-transition.opacity
        @click="open = false"
        class="fixed inset-0 z-40 bg-slate-950/55 backdrop-blur-[2px] lg:hidden"
    ></div>

    <x-admin.nav
        :items="$nav"
        :brand="$brand"
        :brand-short="$brandShort"
        :panel-label="config('livewire-admin.panel_label', 'Yönetim')"
        :site-name="config('livewire-admin.brand_name')"
        :site-url="url('/')"
        :logout-route="route('logout')"
    />

    <div class="flex min-w-0 flex-1 flex-col">
        <header class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/85 backdrop-blur-md">
            <div class="flex items-center justify-between gap-4 px-4 py-3.5 lg:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" class="rounded-xl border border-slate-200 bg-white p-2 text-slate-600 shadow-sm hover:bg-slate-50 lg:hidden" @click="open = true" aria-label="Menü">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-slate-400">Panel</p>
                        <h1 class="text-lg font-semibold tracking-tight text-slate-900">{{ $heading ?? $title ?? 'Panel' }}</h1>
                    </div>
                </div>
            </div>
            <div class="h-0.5 w-full bg-gradient-to-r from-[var(--color-brand)] via-emerald-400/70 to-transparent"></div>
        </header>

        <main class="relative flex-1 p-4 lg:p-8">
            <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(22,163,74,0.06),_transparent_50%)]"></div>
            <div class="relative mx-auto max-w-7xl">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
@else
    <main class="relative flex min-h-screen items-center justify-center overflow-hidden p-4">
        <div class="absolute inset-0 bg-slate-950"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(22,163,74,0.35),_transparent_55%)]"></div>
        <div class="absolute inset-0 opacity-[0.07]" style="background-image: linear-gradient(rgba(255,255,255,.15) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.15) 1px, transparent 1px); background-size: 28px 28px;"></div>
        <div class="relative w-full max-w-md">
            {{ $slot }}
        </div>
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
