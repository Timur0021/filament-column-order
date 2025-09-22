<?php

namespace Tima\FilamentColumnOrder\Widgets;

use Tima\FilamentColumnOrder\Models\ColumnSetting;
use Filament\Widgets\Widget;

class ColumnsOrderWidget extends Widget
{
    protected static string $view = 'filament-column-order::columns-order-widget';

    /** @var string[] */
    public array $order = [];

    /** @var array<string,string> */
    public array $labels = [];

    public string $key = 'default_table_columns';

    public function mount(): void
    {
        $this->order = ColumnSetting::query()
            ->firstOrCreate(
                ['key' => $this->key],
                ['value' => array_keys($this->labels)]
            )->value ?? array_keys($this->labels);
    }

    /**
     * @param array|string $value
     */
    public function updateColumnOrder(array|string $value): void
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (is_array($value)) {
            $value = array_keys($this->labels);
        }

        $this->order = $value;

        ColumnSetting::query()
            ->firstOrCreate(
                ['key' => $this->key],
                ['value' => $this->order]
            );
    }
}