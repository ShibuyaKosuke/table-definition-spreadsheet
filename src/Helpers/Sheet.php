<?php

namespace Shibuyakosuke\TableDefinition\Helpers;

use Shibuyakosuke\TableDefinition\Table;
use Shibuyakosuke\TableDefinition\Traits\ExcelMacro;

/**
 * Class Sheet
 * @package Shibuyakosuke\TableDefinition\Helpers
 */
class Sheet
{
    use ExcelMacro;

    protected $database;
    protected $table;
    protected $columns;
    protected $constraints;
    protected $referencing;
    protected $ranges = [];

    /**
     * TableDefinitionPerTableSheet constructor.
     * @param string $database
     * @param Table $table
     */
    public function __construct(string $database, Table $table)
    {
        $this->database = $database;
        $this->table = $table;
        $this->columns = InformationSchema::getColumns($database, $table->TABLE_NAME);
        $this->constraints = InformationSchema::getConstraints($database, $table->TABLE_NAME);
        $this->referencing = InformationSchema::getReferencingColumns($database, $table->TABLE_NAME);

        static::setMacro();
    }

    /**
     * @param string $tag
     * @param $columns
     * @param $constraints
     * @param $referencing
     * @return array
     */
    protected function getRanges(string $tag, $columns, $constraints, $referencing)
    {
        switch ($tag) {
            case 'th':
                return [
                    [
                        'start' => ['column' => 1, 'row' => 2],
                        'end' => ['column' => 1, 'row' => 7]
                    ],
                    [
                        'start' => ['column' => 1, 'row' => 10],
                        'end' => ['column' => 8, 'row' => 10]
                    ],
                    [
                        'start' => ['column' => 1, 'row' => $columns->count() + 13],
                        'end' => ['column' => 8, 'row' => $columns->count() + 13]
                    ],
                    [
                        'start' => ['column' => 1, 'row' => $columns->count() + 16 + $constraints->count()],
                        'end' => ['column' => 8, 'row' => $columns->count() + 16 + $constraints->count()]
                    ],
                ];
            case 'table':
                return [
                    [
                        'start' => ['column' => 1, 'row' => 2],
                        'end' => ['column' => 4, 'row' => 7]
                    ],
                    [
                        'start' => ['column' => 1, 'row' => 10],
                        'end' => ['column' => 8, 'row' => 10 + $columns->count()]
                    ],
                    [
                        'start' => ['column' => 1, 'row' => $columns->count() + 13],
                        'end' => ['column' => 8, 'row' => $columns->count() + $constraints->count() + 13]
                    ],
                    [
                        'start' => ['column' => 1, 'row' => $columns->count() + $constraints->count() + 16],
                        'end' => ['column' => 8, 'row' => $columns->count() + $constraints->count() + $referencing->count() + 16]
                    ],
                ];
        }
    }
}