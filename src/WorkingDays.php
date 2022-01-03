<?php

namespace Spyrmp\WorkingDays;

use Carbon\Carbon;
use Illuminate\Contracts\Config\Repository;

class WorkingDays
{


    /**
     * @var mixed
     */
    private $workingDays;
    /**
     * @var mixed
     */
    private $nonWorkingDay;

    /**
     * @param Repository $config
     * @return void
     */
    public function __construct($config)
    {
        $this->workingDays = $config->get('working-days.working');
        $this->nonWorkingDay = $config->get('working-days.non_working');
    }

    /**
     * @param Carbon $carbon
     * @return false|mixed
     */
    public function isWorkingDay($carbon)
    {

        $flag = false;
        foreach ($this->workingDays as $workingDay) {
            if ($flag = $carbon->is($workingDay)) {
                break;
            }
        }
        return $flag;
    }

    /**
     * @param Carbon $carbon
     * @return Carbon[]
     */
    public function getNonWorkingDays($carbon): array
    {
        $results = [];

        for ($i = 0; $i < 7; $i++) {
            $currentDay = $carbon->startOfWeek()->addDay($i);
            if ($this->isNonWorkingDay($currentDay)) {
                $results[] = $currentDay;
            }
        }
        return $results;
    }
    /**
     * @param Carbon $carbon
     * @return Carbon[]
     */
    public function getWorkingDays($carbon): array
    {
        $results = [];

        for ($i = 0; $i < 7; $i++) {
            $currentDay = $carbon->startOfWeek()->addDay($i);
            if ($this->isWorkingDay($currentDay)) {
                $results[] = $currentDay;
            }
        }
        return $results;
    }

    /**
     * @param Carbon $carbon
     * @return bool
     */
    public function isNonWorkingDay($carbon)
    {
        $flag = false;
        foreach ($this->nonWorkingDay as $nonWorkingDay) {
            if ($flag = $carbon->is($nonWorkingDay)) {
                break;
            }
        }

        return $flag;
    }
}
