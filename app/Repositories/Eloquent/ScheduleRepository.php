<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ScheduleRepositoryInterface;
use App\Models\Schedule;

class ScheduleRepository extends Repository implements ScheduleRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Schedule::class;
    }
}
