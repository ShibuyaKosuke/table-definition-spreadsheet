# laravel-table-definition-spredsheet

Export Table definition to spreadsheet by artisan command

```bash
$ php artisan db:definition
```

## Required

MySQL only.

Exec migration before exporting.

```bash
$ php artisan migrate
$ php artisan db:definition
```

## Install

```bash
$ composer require shibuyakosuke/table-definition-spreadsheet 
```