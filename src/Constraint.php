<?php

namespace Shibuyakosuke\TableDefinition;

use Illuminate\Database\Eloquent\Model;

class Constraint extends Model
{
    protected $table = 'information_schema.KEY_COLUMN_USAGE';
}