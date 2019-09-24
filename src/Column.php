<?php

namespace Shibuyakosuke\TableDefinition;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'information_schema.columns';
}