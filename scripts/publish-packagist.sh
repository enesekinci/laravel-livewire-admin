#!/usr/bin/env bash
# Submit all Enes Livewire admin stack packages to Packagist (one-time).
# Requires: PACKAGIST_API_TOKEN from https://packagist.org/profile/
set -euo pipefail

USERNAME="${PACKAGIST_USERNAME:-enesekinci}"
TOKEN="${PACKAGIST_API_TOKEN:-}"

if [[ -z "$TOKEN" ]]; then
    echo "Set PACKAGIST_API_TOKEN (Profile → Show API Token on packagist.org)"
    exit 1
fi

# Leaf packages first, meta package last (depends on the first four).
PACKAGES=(
    laravel-livewire-admin-ui
    laravel-livewire-flash-toast
    laravel-livewire-confirm-modal
    laravel-livewire-search-select
    laravel-livewire-media
    laravel-livewire-rich-text
    laravel-livewire-admin
)

for repo in "${PACKAGES[@]}"; do
    url="https://github.com/enesekinci/${repo}"
    echo "→ enesekinci/${repo}"
    response="$(curl -sS -X POST \
        "https://packagist.org/api/create-package?username=${USERNAME}&apiToken=${TOKEN}" \
        -H "Content-Type: application/json" \
        -d "{\"repository\":{\"url\":\"${url}\"}}")"
    echo "  ${response}"
    sleep 1
done

echo ""
echo "Done. Verify: https://packagist.org/packages/enesekinci/"
echo "Enable GitHub auto-update: Profile → GitHub → grant hook access (if not already)."
