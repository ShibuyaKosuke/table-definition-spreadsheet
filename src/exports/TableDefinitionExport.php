<?php

namespace Shibuyakosuke\TableDefinition\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Shibuyakosuke\TableDefinition\Helpers\InformationSchema;

/**
 * Class TableDefinitionExport
 * @package Shibuyakosuke\TableDefinition\Exports
 */
class TableDefinitionExport implements WithMultipleSheets, WithEvents
{
    use Exportable;

    private $output;

    /**
     * TableDefinitionExport constructor.
     * @param $output
     */
    public function __construct($output)
    {
        $this->output = $output;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $database_name = config('database.connections.mysql.database');
        $tables = InformationSchema::getTables($database_name);

        $sheets[] = new TableListIndexExport($database_name);

        $progressBar = $this->output->createProgressBar($tables->count());

        $tables->each(function ($table) use ($database_name, &$sheets, &$progressBar) {
            $progressBar->advance();
            $sheets[] = new TableDefinitionPerTableSheet($database_name, $table);
        });

        $progressBar->finish();
        $this->output->writeln('');

        return $sheets;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function (BeforeExport $event) {
                $this->output->writeln('Exporting...');
            },
            BeforeWriting::class => function (BeforeWriting $event) {
                $this->output->writeln('Writing...');
            },
        ];
    }
}