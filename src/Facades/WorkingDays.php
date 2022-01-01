<?php

namespace Spyrmp\WorkingDays\Facades;

use Illuminate\Support\Facades\Facade;

class WorkingDays extends Facade

{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'working-days';
    }
}
