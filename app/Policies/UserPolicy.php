<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function index($user)
    {
        return $this->isAuthorized($user, config('frsm.permission.user.listUser'));
    }

    /**
     * @return mixed
     */
    public function create($user)
    {
        return $this->isAuthorized($user, config('frsm.permission.user.createUser'));
    }

    /**
     * @return mixed
     */
    public function manage($user)
    {
        return $this->isAuthorized($user, config('frsm.permission.others.manage'));
    }
}
