<?php

namespace Shibuyakosuke\TableDefinition\Console;

use Illuminate\Console\Command;
use Shibuyakosuke\TableDefinition\Exports\TableDefinitionExport;

class TableDefinitionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:definition';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output table definition to spreadsheet.';

    /**
     * @return void
     */
    public function handle(): void
    {
        if (config('database.default') !== 'mysql') {
            $this->error('This command is not available, unless you use MySQL.');
            return;
        }

        $this->info('Starting export table definition.');

        (new TableDefinitionExport($this->output))->store('table-definition.xlsx');

        $this->output->writeln('Finish.');
    }
}
