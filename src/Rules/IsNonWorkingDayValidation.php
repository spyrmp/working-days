<?php


namespace Spyrmp\WorkingDays\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use WorkingDays;

class IsNonWorkingDayValidation extends AbstractValidation implements Rule
{

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        $dateValue = Carbon::createFromFormat($this->format, $value);
        return WorkingDays::isNonWorkingDay($dateValue);
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return trans('working-days::working-days.is_not_working_day');
    }
}
