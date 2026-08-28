# Packagist — admin stack paketleri

Tüm repolar **public GitHub** + semver **git tag** ile hazır. Packagist sürümü tag’lerden alır (`composer.json` içindeki `version` alanı kullanılmaz).

## 1. Packagist hesabı (bir kez)

1. https://packagist.org/register — GitHub ile giriş önerilir.
2. **Profile → GitHub** — hesabı bağla, **Public Repository Access** ver (auto-update webhook için).
3. **Profile → Show API Token** — token’ı kopyala.

## 2. Paketleri gönder (sıra önemli)

Meta paket alt paketlere bağlı; önce yaprak paketler:

```bash
export PACKAGIST_API_TOKEN=xxxxxxxx
bash scripts/publish-packagist.sh
```

Elle de ekleyebilirsin: [Submit](https://packagist.org/packages/submit) → her repo için `https://github.com/enesekinci/<repo>`.

| Sıra | Paket | Son tag |
|------|--------|---------|
| 1 | `enesekinci/laravel-livewire-admin-ui` | v1.2.1 |
| 2 | `enesekinci/laravel-livewire-flash-toast` | v1.0.0 |
| 3 | `enesekinci/laravel-livewire-confirm-modal` | v1.0.0 |
| 4 | `enesekinci/laravel-livewire-search-select` | v1.0.3 |
| 5 | `enesekinci/laravel-livewire-media` | v1.2.1 |
| 6 | `enesekinci/laravel-livewire-rich-text` | v1.2.1 |
| 7 | `enesekinci/laravel-livewire-admin` | v1.0.0 |

## 3. Doğrula

```bash
composer clear-cache
composer show enesekinci/laravel-livewire-admin --all
```

Packagist sayfası: https://packagist.org/packages/enesekinci/laravel-livewire-admin

## 4. Laravel projelerinde VCS repo’ları kaldır

Packagist’te göründükten sonra `composer.json` içindeki tüm `repositories` (enesekinci VCS) bloğu silinir. Composer varsayılan olarak Packagist’ten çeker — **GitHub API limiti biter**.

```bash
composer update enesekinci/laravel-livewire-admin enesekinci/laravel-livewire-media enesekinci/laravel-livewire-rich-text -W
```

## 5. Yeni sürüm akışı (değişmez)

```bash
# paket reposunda
git tag v1.2.2 && git push origin v1.2.2
# Packagist webhook otomatik günceller (~1 dk)
```

Forge deploy: `deploy/stack-update.sh` aynı kalır; artık Packagist’ten `prefer-dist` ile indirir.

## Lokal geliştirme

`composer.local.json` (path symlink) Packagist ile birlikte çalışmaya devam eder; merge-plugin path repo’ları önceliklendirir.
