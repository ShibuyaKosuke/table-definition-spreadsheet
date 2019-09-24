<?php

namespace Shibuyakosuke\TableDefinition\Providers;

use Illuminate\Support\ServiceProvider;
use Shibuyakosuke\TableDefinition\Console\TableDefinitionCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->registerCommands();
    }

    public function register()
    {
        // register bindings
    }

    protected function registerCommands()
    {
        $this->app->singleton('command.db.definition', function () {
            return new TableDefinitionCommand();
        });

        $this->commands([
            'command.db.definition',
        ]);
    }

    public function provides()
    {
        return [
            'command.db.definition',
        ];
    }
}