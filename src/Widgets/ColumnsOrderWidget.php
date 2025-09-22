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

    public function updatedOrder(array $value): void
    {
        $this->order = $value;

        ColumnSetting::query()
            ->updateOrCreate(
                ['key' => $this->key],
                ['value' => $this->order]
            );
    }
}