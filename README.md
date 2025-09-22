# Filament Column Order Widget

Пакет для Filament, який дозволяє змінювати порядок колонок у таблицях через drag & drop та зберігати його у базі даних.

---

## Встановлення

1. Встановити пакет:

```bash
composer require tima/filament-column-order

2.Опублікувати ресурси та міграції:

php artisan vendor:publish --tag=filament-column-order-views
php artisan vendor:publish --tag=filament-column-order-migrations
php artisan migrate

Використання
1. Додати віджет у Resource:

use Tima\FilamentColumnOrder\Widgets\ColumnsOrderWidget;

protected function getHeaderWidgets(): array
{
    return [
        ColumnsOrderWidget::make([
            'labels' => [
                'id' => 'ID',
                'title' => 'Назва',
                'active' => 'Статус',
            ],
            'key' => 'products_table_columns',
        ]),
    ];
}
Це створить drag & drop віджет для сортування колонок.

2. Використовувати порядок колонок у Table

use Tima\FilamentColumnOrder\Widgets\ColumnsOrderWidget;
use Filament\Tables\Columns\TextColumn;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;

$allColumns = [
    'id' => TextColumn::make('id')->label('ID')->sortable()->searchable(),
    'title' => TextColumn::make('title')->label('Назва'),
    'active' => ToggleIconColumn::make('active')->label('Статус'),
];

$order = ColumnsOrderWidget::getOrder('products_table_columns', array_keys($allColumns));

$table->columns(ColumnsOrderWidget::sortColumns($order, $allColumns));

3. Drag & Drop

Віджет автоматично підключає SortableJS
 і дозволяє змінювати порядок колонок. Порядок зберігається у таблиці setting_columns.
