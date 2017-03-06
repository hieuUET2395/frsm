<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface as PermissionRepository;

class BasePolicy
{
    use HandlesAuthorization;
    private $userRepository;
    private $permissionRepository;

    /**
     * BasePolicy constructor.
     */
    public function __construct(UserRepository $userRepository, PermissionRepository $permissionRepository)
    {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * @param $user
     * @param $action
     * @return bool
     */
    public function isAuthorized($user, $action)
    {
        $requestedPermission = $this->permissionRepository->findBy('name', $action);
        $allPermissions = $user->permissions;
        if ($allPermissions) {
            return $allPermissions->contains($requestedPermission->id);
        }

        return false;
    }
}
