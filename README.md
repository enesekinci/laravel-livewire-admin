# laravel-livewire-admin

Meta package for the **Enes Ekinci Livewire admin stack**.

Bundles (via Composer):

- `enesekinci/laravel-livewire-admin-ui`
- `enesekinci/laravel-livewire-flash-toast`
- `enesekinci/laravel-livewire-confirm-modal`
- `enesekinci/laravel-livewire-search-select`

Optional add-ons (install separately):

- `enesekinci/laravel-livewire-media` — R2/S3 media picker
- `enesekinci/laravel-livewire-rich-text` — TipTap editor

## Install

```bash
composer require enesekinci/laravel-livewire-admin
# optional
composer require enesekinci/laravel-livewire-media enesekinci/laravel-livewire-rich-text
```

Add VCS repositories to `composer.json` if packages are private on GitHub (see `AGENTS.md` in your app).

## Publish stubs

```bash
php artisan vendor:publish --tag=livewire-admin-stubs
php artisan vendor:publish --tag=livewire-admin-config
```

Then in `resources/css/app.css`:

```css
@import './admin-package-sources.css';
@theme {
    --color-brand: #0b5cab; /* your brand */
}
```

Customize `resources/views/layouts/admin.blade.php` navigation for your app.

## Layout hosts

```blade
<livewire:media-picker />
<livewire:flash-toast />
<livewire:confirm-modal />
```

See published `AGENTS.md` for full component reference.
