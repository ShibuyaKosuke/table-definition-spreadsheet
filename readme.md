# laravel-table-definition-spredsheet

This repository has been out of date!

Use [https://github.com/ShibuyaKosuke/laravel-ddl-export](https://github.com/ShibuyaKosuke/laravel-ddl-export) instead.

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
