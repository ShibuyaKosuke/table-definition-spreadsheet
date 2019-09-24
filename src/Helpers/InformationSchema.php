<?php

namespace Shibuyakosuke\TableDefinition\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Shibuyakosuke\TableDefinition\Table;

/**
 * Class InformationSchema
 * @package Shibuyakosuke\TableDefinition\Helpers
 */
class InformationSchema
{
    /**
     * @param string $database
     * @return Collection
     */
    public static function getTables(string $database)
    {
        return Table::query()
            ->where('TABLE_SCHEMA', $database)
            ->where('table_name', '<>', 'migrations')
            ->orderBy('table_name')
            ->get();
    }

    /**
     * @param string $database
     * @param string $table
     * @return Collection
     */
    public static function getColumns(string $database, string $table)
    {
        return DB::table('INFORMATION_SCHEMA.COLUMNS')
            ->selectRaw('INFORMATION_SCHEMA.COLUMNS.*, CONSTRAINT_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME')
            ->leftJoin('INFORMATION_SCHEMA.KEY_COLUMN_USAGE', function ($join) {
                $join->whereColumn('COLUMNS.TABLE_SCHEMA', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.TABLE_SCHEMA')
                    ->whereColumn('COLUMNS.TABLE_NAME', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.TABLE_NAME')
                    ->whereColumn('COLUMNS.COLUMN_NAME', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.COLUMN_NAME');
            })
            ->where('COLUMNS.TABLE_SCHEMA', $database)
            ->where('COLUMNS.TABLE_NAME', $table)
            ->orderBy('COLUMNS.ORDINAL_POSITION')
            ->get();
    }

    /**
     * @param string $database
     * @param string $table
     * @return Collection
     */
    public static function getConstraints(string $database, string $table)
    {
        return DB::table('INFORMATION_SCHEMA.COLUMNS')
            ->selectRaw('INFORMATION_SCHEMA.COLUMNS.*, CONSTRAINT_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME')
            ->leftJoin('INFORMATION_SCHEMA.KEY_COLUMN_USAGE', function ($join) {
                $join->whereColumn('COLUMNS.TABLE_SCHEMA', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.TABLE_SCHEMA')
                    ->whereColumn('COLUMNS.TABLE_NAME', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.TABLE_NAME')
                    ->whereColumn('COLUMNS.COLUMN_NAME', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.COLUMN_NAME');
            })
            ->where('COLUMNS.TABLE_SCHEMA', $database)
            ->where('COLUMNS.TABLE_NAME', $table)
            ->orderBy('COLUMNS.ORDINAL_POSITION')
            ->whereNotNull('CONSTRAINT_NAME')
            ->get();
    }

    /**
     * @param string $database
     * @param string $table
     * @return Collection
     */
    public static function getReferencingColumns(string $database, string $table)
    {
        return DB::table('INFORMATION_SCHEMA.COLUMNS')
            ->selectRaw('INFORMATION_SCHEMA.COLUMNS.*, CONSTRAINT_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME')
            ->leftJoin('INFORMATION_SCHEMA.KEY_COLUMN_USAGE', function ($join) {
                $join->whereColumn('COLUMNS.TABLE_SCHEMA', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.TABLE_SCHEMA')
                    ->whereColumn('COLUMNS.TABLE_NAME', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.TABLE_NAME')
                    ->whereColumn('COLUMNS.COLUMN_NAME', 'INFORMATION_SCHEMA.KEY_COLUMN_USAGE.COLUMN_NAME');
            })
            ->where('REFERENCED_TABLE_SCHEMA', $database)
            ->where('REFERENCED_TABLE_NAME', $table)
            ->get();
    }
}