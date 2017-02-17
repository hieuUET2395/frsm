<?php
namespace app\Repositories\Criteria\Candidate;

use App\Repositories\Contracts\RepositoryInterface as Repository;
use App\Repositories\Criteria\Criteria;

class NameCriteria extends Criteria
{
    private $name;

    /**
     * NameCriteria constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->where('name', 'LIKE', '%' . $this->name . '%');

        return $model;
    }
}
