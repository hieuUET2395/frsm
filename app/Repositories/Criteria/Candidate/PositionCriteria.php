<?php
namespace App\Repositories\Criteria\Candidate;

use App\Models\Position;
use App\Repositories\Criteria\Criteria;
use App\Repositories\Contracts\RepositoryInterface as Repository;

class PositionCriteria extends Criteria
{
    private $position;

    /**
     * PositionCriteria constructor.
     * @param $position
     */
    public function __construct($position)
    {
        $this->position = $position;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        if ($this->position > 0) {
            $model = $model->where('position_id', '=', $this->position);
        }

        return $model;
    }
}
