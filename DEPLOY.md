# Admin stack — deploy & güncelleme

Bu paketleri kullanan Laravel projelerinde (caganmekanik, can-solar-enerji, …) **aynı akış**.

## Strateji

| Ortam | Ne olur |
|---|---|
| **Production deploy** | `composer update enesekinci/*` → semver içinde en son tag çekilir |
| **Local geliştirme** | İsteğe bağlı `composer.local.json` → `../laravel-livewire-*` path symlink |
| **Paket geliştirme** | Paket reposunda tag at (`v1.2.2`) → deploy'da otomatik gelir |

Constraint'ler `^1.0`, `^1.2` gibi kalmalı — **major** sürüm deploy'da otomatik gelmez (kasıtlı).

---

## 1. Composer kaynağı

Paketler **Packagist**’te: `enesekinci/laravel-livewire-*`. Projede ekstra `repositories` gerekmez.

İlk kurulum / Packagist rehberi: [PACKAGIST.md](./PACKAGIST.md).

## 2. Deploy hook (Forge / sunucu)

Deploy script'te `composer install` **öncesinde** veya **sonrasında** stack güncelle:

```bash
# Enes admin stack — semver içinde en son sürümler
composer update \
  enesekinci/laravel-livewire-admin \
  enesekinci/laravel-livewire-media \
  enesekinci/laravel-livewire-rich-text \
  -W --no-dev --no-interaction --prefer-dist

composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

npm ci --ignore-scripts
npm run build

php artisan migrate --force
php artisan optimize
php artisan queue:restart
```

Projede hazır script: `./deploy/stack-update.sh` (sadece composer+npm kısmı).

**Forge:** Site → Deployment → Deploy Script içine `deploy/stack-update.sh` satırını ekle (git pull'dan sonra).

---

## 3. Lokal: canlı paket geliştirme

```bash
cp composer.local.json.example composer.local.json
composer update enesekinci/laravel-livewire-admin -W
```

`composer.local.json` gitignore'da — path repo'lar sibling `../laravel-livewire-*` klasörlerine symlink yapar.

Pakette değişiklik yaptıktan sonra production'a almak için:

```bash
cd ../laravel-livewire-media
git tag v1.2.2 && git push origin v1.2.2
# deploy otomatik çeker
```

---

## 4. Composer script (projede)

```bash
composer stack:update    # local, tüm constraint'ler dahil
composer stack:update -- --no-dev   # deploy benzeri
```

---

## 5. Tag disiplini

Her paket fix/feature → semver tag:

- patch: `v1.2.1` → `v1.2.2` (bugfix, cursor, overflow)
- minor: `v1.2.0` → `v1.3.0` (yeni component)
- major: `v2.0.0` (breaking — composer constraint güncelle)

Meta paket `laravel-livewire-admin` tag'i, alt paket minimum sürümlerini yükselttiğinde artırılır.

---

## 6. Bleeding edge (isteğe bağlı, önerilmez prod'da)

```json
"enesekinci/laravel-livewire-admin": "dev-main@dev"
```

+ `"minimum-stability": "dev"`. Her deploy `main`'in son commit'ini alır — tag disiplini olmadan riskli.

---

## Projeler

| Proje | Stack require |
|---|---|
| caganmekanik.com | admin + media + rich-text |
| can-solar-enerji | geçiş sonrası aynı (bkz. `ADMIN-STACK-GECIS.md`) |
