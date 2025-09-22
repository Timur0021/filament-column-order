<?php

namespace Vendor\FilamentColumnOrder;

use Illuminate\Support\ServiceProvider;

class ColumnOrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-column-order');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../database/migrations' => $this->app->databasePath('migrations'),
        ], 'filament-column-order-migrations');

        $this->publishes([
            __DIR__ . '/../resources/views' => $this->app->resourcePath('views/vendor/filament-column-order'),
        ], 'filament-column-order-views');
    }
}
