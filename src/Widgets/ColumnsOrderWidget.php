<?php

namespace Tima\FilamentColumnOrder\Widgets;

use Tima\FilamentColumnOrder\Models\ColumnSetting;
use Filament\Widgets\Widget;

class ColumnsOrderWidget extends Widget
{
    protected static string $view = 'filament-column-order::columns-order-widget';

    public array $order = [];

    /** @var array<string,string> */
    public array $labels = [];

    public string $key = 'default_table_columns';

    public function mount(array $labels = [], string $key = null): void
    {
        if ($labels) {
            $this->labels = $labels;
        }
        if ($key) {
            $this->key = $key;
        }

        $this->order = ColumnSetting::query()
            ->firstOrCreate(
                ['key' => $this->key],
                ['value' => array_keys($this->labels)]
            )->value ?? array_keys($this->labels);
    }

    public function updatedOrder(array|string $value): void
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (!is_array($value)) {
            $value = array_keys($this->labels);
        }

        $this->order = $value;

        ColumnSetting::query()
            ->updateOrCreate(
                ['key' => $this->key],
                ['value' => $this->order]
            );
    }

    /**
     * @param array $allColumns
     * @return array
     */
    public function getSortedColumns(array $allColumns): array
    {
        return collect($this->order)
            ->map(fn($key) => $allColumns[$key] ?? null)
            ->filter()
            ->toArray();
    }
}