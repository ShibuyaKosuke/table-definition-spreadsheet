<?php

namespace Shibuyakosuke\TableDefinition;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'information_schema.tables';
}