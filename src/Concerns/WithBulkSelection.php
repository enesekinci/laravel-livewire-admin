<?php

declare(strict_types=1);

namespace EnesEkinci\LivewireAdmin\Concerns;

/**
 * Livewire listelerinde toplu seçim / işlem için ortak state.
 *
 * Kullanım:
 * - Trait'i Index component'e ekle
 * - getBulkSelectableIds() ile mevcut sayfa (veya filtrelenmiş) id'leri döndür
 * - View'da x-admin.bulk-bar + x-admin.table.select-all / select-row kullan
 */
trait WithBulkSelection
{
    /** @var list<int|string> */
    public array $selected = [];

    public bool $selectAllPage = false;

    /**
     * Mevcut sayfada / listede seçilebilir kayıt id'leri.
     *
     * @return list<int|string>
     */
    abstract protected function getBulkSelectableIds(): array;

    public function updatedSelectAllPage(bool $value): void
    {
        if ($value) {
            $this->selected = array_values(array_map(
                static fn (int|string $id): string => (string) $id,
                $this->getBulkSelectableIds()
            ));

            return;
        }

        $this->selected = [];
    }

    public function updatedSelected(): void
    {
        $ids = array_map(static fn (int|string $id): string => (string) $id, $this->getBulkSelectableIds());
        $selected = array_map(static fn (int|string $id): string => (string) $id, $this->selected);

        $this->selectAllPage = $ids !== [] && count(array_diff($ids, $selected)) === 0;
    }

    public function clearBulkSelection(): void
    {
        $this->selected = [];
        $this->selectAllPage = false;
    }

    public function getSelectedCountProperty(): int
    {
        return count($this->selected);
    }

    /**
     * @return list<int>
     */
    protected function selectedIdsAsInt(): array
    {
        return array_values(array_map(static fn (int|string $id): int => (int) $id, $this->selected));
    }
}
