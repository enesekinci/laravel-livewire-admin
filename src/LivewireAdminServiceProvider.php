<?php

namespace EnesEkinci\LivewireAdmin;

use Illuminate\Support\ServiceProvider;

class LivewireAdminServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/livewire-admin.php', 'livewire-admin');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/livewire-admin.php' => config_path('livewire-admin.php'),
        ], 'livewire-admin-config');

        $this->publishes([
            __DIR__.'/../stubs/AGENTS.md' => base_path('AGENTS.md'),
            __DIR__.'/../stubs/enes-livewire-stack.mdc' => base_path('.cursor/rules/enes-livewire-stack.mdc'),
            __DIR__.'/../stubs/css-package-sources.css' => resource_path('css/admin-package-sources.css'),
            __DIR__.'/../stubs/layouts/admin.blade.php' => resource_path('views/layouts/admin.blade.php'),
        ], 'livewire-admin-stubs');
    }
}
