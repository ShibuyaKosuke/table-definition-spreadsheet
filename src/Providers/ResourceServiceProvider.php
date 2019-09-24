<?php

namespace Shibuyakosuke\TableDefinition\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ResourceServiceProvider
 * @package Shibuyakosuke\TableDefinition\Providers
 */
class ResourceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // View
        $this->loadViewsFrom(realpath(__DIR__ . '/../views'), 'table-definition-spreadsheet');

        $this->publishes([
            realpath(__DIR__ . '/../views') => resource_path('views/vendor/table-definition-spreadsheet'),
        ]);

        // Lang
        $this->loadTranslationsFrom(__DIR__ . '/../translations', 'table-definition-spreadsheet');

        $this->publishes([
            __DIR__ . '/../translations' => resource_path('lang/vendor/table-definition-spreadsheet'),
        ]);
    }
}