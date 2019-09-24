<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $table->TABLE_NAME }}</title>
</head>
<body>

<div>
    <p>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.table_info') }}</p>
    <table>
        <tbody>
        <tr>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.system_name') }}</th>
            <td colspan="3">{{ config('app.name') }}</td>
        </tr>
        <tr>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.sub_system_name') }}</th>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.schema_name') }}</th>
            <td colspan="3">{{ $table->TABLE_SCHEMA }}</td>
        </tr>
        <tr>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.logical_table_name') }}</th>
            <td colspan="3">{{ $table->TABLE_COMMENT }}</td>
        </tr>
        <tr>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.physical_table_name') }}</th>
            <td colspan="3">{{ $table->TABLE_NAME }}</td>
        </tr>
        <tr>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.rdbms') }}</th>
            <td colspan="3"></td>
        </tr>
        </tbody>
    </table>
</div>

<div>
    <p>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.column_info') }}</p>
    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.logical_name') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.physical_name') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.data_type') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.not_null') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.default') }}</th>
            <th colspan="2">{{ __('table-definition-spreadsheet::table-definition-spreadsheet.extra') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($columns as $column)
            <tr>
                <td>{{ $column->ORDINAL_POSITION }}</td>
                <td>{{ $column->COLUMN_COMMENT }}</td>
                <td>{{ $column->COLUMN_NAME }}</td>
                <td>{{ $column->COLUMN_TYPE }}</td>
                <td>
                    @if($column->IS_NULLABLE === 'NO')
                        Yes
                    @endif
                </td>
                <td>{{ $column->COLUMN_DEFAULT }}</td>
                <td colspan="2">{{ $column->COLLATION_NAME }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div>
    <p>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.index_info') }}</p>
    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th colspan="2">{{ __('table-definition-spreadsheet::table-definition-spreadsheet.index_name') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.column_list') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.primary_key') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.unique') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.referenced_table') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.referenced_column') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($constraints as $i => $constraint)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td colspan="2">{{ $constraint->CONSTRAINT_NAME }}</td>
                <td>{{ $constraint->COLUMN_NAME }}</td>
                <td>
                    @if($constraint->CONSTRAINT_NAME === 'PRIMARY')
                        Yes
                    @endif
                </td>
                <td>
                    @if($constraint->COLUMN_KEY === 'UNI')
                        Yes
                    @endif
                </td>
                <td>
                    @if($constraint->REFERENCED_TABLE_NAME)
                        {{ $constraint->REFERENCED_TABLE_NAME }}
                    @endif
                </td>
                <td>
                    @if($constraint->REFERENCED_COLUMN_NAME)
                        {{ $constraint->REFERENCED_COLUMN_NAME }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div>
    <p>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.referencing_key') }}</p>
    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th colspan="2">{{ __('table-definition-spreadsheet::table-definition-spreadsheet.foreign_key') }}</th>
            <th colspan="2">{{ __('table-definition-spreadsheet::table-definition-spreadsheet.column_list') }}</th>
            <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.referencing_table') }}</th>
            <th colspan="2">{{ __('table-definition-spreadsheet::table-definition-spreadsheet.referencing_column') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($referencing as $i => $ref)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td colspan="2">{{ $ref->CONSTRAINT_NAME }}</td>
                <td colspan="2">{{ $ref->REFERENCED_COLUMN_NAME }}</td>
                <td>{{ $ref->TABLE_NAME }}</td>
                <td colspan="2">{{ $ref->COLUMN_NAME }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
