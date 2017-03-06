<?php
namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionRepository extends Repository implements PermissionRepositoryInterface
{
    /**
     * @return mixed
     */
    public function model()
    {
       return Permission::class;
    }

    public function getManagePermission()
    {
        return $this->findBy('name',config('frsm.permission.others.manage'));
    }
}
