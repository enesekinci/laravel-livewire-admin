# AGENTS.md — {{APP_NAME}}

## Stack (do not ask — just use)

Install: `enesekinci/laravel-livewire-admin` (+ optional `media`, `rich-text`).

| Need | API |
|---|---|
| UI primitives | `x-admin.*` (button, input, card, table, stat, …) |
| Table structure | `x-admin.table.head/body/row/th/td/empty/actions` |
| Pagination | `x-admin.pagination :paginator="$items"` |
| Page layout | `x-admin.page`, `x-admin.page-header`, `x-admin.toolbar`, `x-admin.actions` |
| Forms | `x-admin.fields`, `x-admin.checkbox`, `x-admin.error`, `x-admin.hint`, `x-admin.file` |
| Detail views | `x-admin.field`, `x-admin.section-title`, `x-admin.badge`, `x-admin.link` |
| Feedback UI | `x-admin.badge`, `x-admin.alert`, `x-admin.metric`, `x-admin.metrics`, `x-admin.panel` |
| Searchable selects | `x-search-select` |
| Rich text | `x-rich-text` (requires media package) |
| Media library | `<livewire:media-picker />` |
| Toasts | `$this->dispatch('toast', message: '...', type: 'success'|'error')` |
| Delete confirm | `$this->dispatch('confirm', message: '...', event: '...', payload: [...])` |

## Hard rules

1. Never ask which UI kit to use — use the table above.
2. After save/delete success → dispatch `toast`.
3. Destructive actions → `confirm` event, then handler + toast.
4. Editor images → media picker (CDN). Temp uploads: `LIVEWIRE_TEMPORARY_FILE_UPLOAD_DISK=local`.
5. Do not copy `x-admin.*` into `resources/views/components/admin/` — they come from packages.
6. Domain CRUD stays in this app — not in packages.
7. Locale: Turkish (`APP_LOCALE=tr`).

## Layout (mount once in `layouts/admin.blade.php`)

```blade
<livewire:media-picker />
<livewire:flash-toast />
<livewire:confirm-modal />
```

## CSS

Add `@import './admin-package-sources.css';` to `resources/css/app.css` (publish stubs first).

## Package source AGENTS

Each sub-package has its own `AGENTS.md` on GitHub when editing package code.
