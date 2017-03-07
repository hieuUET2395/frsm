<?php

namespace App\Repositories\Criteria\Candidate;

use App\Repositories\Contracts\RepositoryInterface as Repository;
use App\Repositories\Criteria\Criteria;

class PhoneCriteria extends Criteria
{
    private $phone;

    /**
     * PhoneCriteria constructor.
     * @param $phone
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->where('phone', 'LIKE', '%' . $this->phone . '%');

        return $model;
    }

}
