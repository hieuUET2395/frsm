<?php

namespace app\Repositories\Criteria\Candidate;

use App\Repositories\Contracts\RepositoryInterface as Repository;
use App\Repositories\Criteria\Criteria;

class StatusCriteria extends Criteria
{
    private $status;

    /**
     * StatusCriteria constructor.
     * @param $status
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        if ($this->status != '') {
            $model = $model->where('status', '=', $this->status);
        }

        return $model;
    }

}
