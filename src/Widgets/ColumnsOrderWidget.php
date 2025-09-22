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

    public static function sortColumns(array $order, array $allColumns): array
    {
        return collect($order)
            ->map(fn($key) => $allColumns[$key] ?? null)
            ->filter()
            ->toArray();
    }

    public static function getOrder(string $key, array $defaultLabels): array
    {
        return ColumnSetting::query()
            ->firstOrCreate(
                ['key' => $key],
                ['value' => array_keys($defaultLabels)]
            )->value ?? array_keys($defaultLabels);
    }
}