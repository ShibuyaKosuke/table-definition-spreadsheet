<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.table_list') }}</title>
</head>
<body>
<p>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.table_list') }}</p>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.logical_name') }}</th>
        <th>{{ __('table-definition-spreadsheet::table-definition-spreadsheet.physical_name') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tables as $i => $table)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $table->TABLE_COMMENT }}</td>
            <td>{{ $table->TABLE_NAME }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
