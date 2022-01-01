# working-days

Laravel plugin for working days.Get working days from the current week. Use custom validation for Date fields.

## Install

This project can be installed via Composer run the following command:

```bash
composer require spyrmp/working-days
```

## Add the Service Provider & Facade/Alias

Once spyrmp/working-days is installed, you need to register the service provider in config/app.php. Make sure to add the
following line above the RouteServiceProvider.

```PHP
\Spyrmp\WorkingDays\WorkingDayServiceProvider::class,
```

You may add the following `aliases` to your `config/app.php`:

```PHP
'WorkingDays' => Spyrmp\WorkingDays\Facades\WorkingDays::class,
```

Publish the package config file by running the following command:

```
php artisan vendor:publish --provider="Spyrmp\WorkingDays\WorkingDayServiceProvider" --tag="working-day-config"
```

## Usage

Get working days of the current week

```php
$carbon = Carbon::make('2022-01-03'); // First day of the week
$workingDays = \WorkingDays::getWorkingDays($carbon);
dd($workingDays); // Carbon[]|[]
```

Get non-working days of the current week

```php
$carbon = Carbon::make('2022-01-03'); // First day of the week
$nonWorkingDays = \WorkingDays::getNonWorkingDays($carbon);
dd($nonWorkingDays); // Carbon[]|[]
```
###Validation Rules
> is_non_working_day

The field under validation must be a value of non-working days.
The dates will be passed into the PHP Carbon function in order to be converted into a valid DateTime instance.

>is_working_day

The field under validation must be a value of working days.
The dates will be passed into the PHP Carbon function in order 
to be converted into a valid DateTime instance.

```php
$rule= [
       "date1"=>"is_non_working_day"
       "date2"="is_working_day"
];
$inputs = $request->all();
$validation = Validator::make($inputs, $rule);
```
