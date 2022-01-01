<?php


namespace Spyrmp\WorkingDays\Rules;




abstract class AbstractValidation
{

    protected $attribute;


    protected $format;

    public function __construct()
    {
        $this->format = config("working-days.format");
    }


}
