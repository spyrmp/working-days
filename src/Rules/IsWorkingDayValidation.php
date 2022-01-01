<?php


namespace Spyrmp\WorkingDays\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use WorkingDays;


class IsWorkingDayValidation extends AbstractValidation implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {

        $dateValue = Carbon::createFromFormat($this->format, $value);

        $this->attribute = $attribute;
        return WorkingDays::isWorkingDay($dateValue);

    }

    public function message()
    {

        return __('working-days::working-days.is_not_working_day');
    }


}
