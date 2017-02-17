<?php

namespace App\Repositories\Criteria\Candidate;

use App\Repositories\Contracts\RepositoryInterface as Repository;
use App\Repositories\Criteria\Criteria;
use Carbon\Carbon;

class DateCriteria extends Criteria
{
    private $date;

    /**
     * DateCriteria constructor.
     * @param $date
     */
    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $date = $this->date;
        if ($date) {
            $dt = Carbon::parse($date);
            $model = $model->whereMonth('created_at', $dt->month)->whereYear('created_at', $dt->year);
        }

        return $model;
    }

}
