<?php

namespace App\Repositories\Criteria\Candidate;

use App\Repositories\Contracts\RepositoryInterface as Repository;
use App\Repositories\Criteria\Criteria;

class EmailCriteria extends Criteria
{
    private $email;

    /**
     * EmailCriteria constructor.
     * @param $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->where('email', 'LIKE', '%' . $this->email . '%');

        return $model;
    }
}
