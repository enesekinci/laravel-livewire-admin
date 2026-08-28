# AGENTS.md — laravel-livewire-admin (meta)

## Purpose

Single Composer entry for the core Enes Ekinci Livewire admin stack.

## Requires (pulled automatically)

| Package | Role |
|---|---|
| `laravel-livewire-admin-ui` | `x-admin.*` Blade components |
| `laravel-livewire-flash-toast` | `<livewire:flash-toast />`, `toast` event |
| `laravel-livewire-confirm-modal` | `<livewire:confirm-modal />`, `confirm` event |
| `laravel-livewire-search-select` | `x-search-select` |

## Optional (suggest only — app must require)

| Package | Role |
|---|---|
| `laravel-livewire-media` | R2/S3 media picker |
| `laravel-livewire-rich-text` | TipTap + media images |

## Hard rules for AI

1. Apps should `composer require enesekinci/laravel-livewire-admin` — not the four core packages individually.
2. Publish stubs: `php artisan vendor:publish --tag=livewire-admin-stubs`.
3. Do not duplicate sub-package code into this meta repo — only composer deps + stubs + config.
4. When editing UI primitives, go to `laravel-livewire-admin-ui` repo.
5. Bump meta tag when minimum sub-package versions change.

## Publish tags

- `livewire-admin-stubs` — AGENTS.md, Cursor rule, layout stub, CSS @source snippet
- `livewire-admin-config` — `config/livewire-admin.php`

## Do not put here

Domain CRUD, app layouts with business nav, R2 credentials.
