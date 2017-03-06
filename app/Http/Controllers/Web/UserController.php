<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use App\Repositories\Contracts\PositionRepositoryInterface as PositionRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface as PermissionRepository;
use App\Models\Contracts\PositionInterface as Position;
use App\Models\Contracts\PermissionInterface as Permission;
use App\Repositories\Criteria\User\EmailCriteria;
use App\Repositories\Criteria\User\NameCriteria;
use App\Repositories\Criteria\User\PositionCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;
    private $positionRepository;
    private $permissionRepository;

    public function __construct(
        UserRepository $userRepository,
        PositionRepository $positionRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Auth::user()->cant('index', User::class), 403);

        $users = $this->userRepository->paginate(setting('paginate'));
        $positions = $this->positionRepository->findAllBy('type', Position::TYPE_USER)->pluck('name', 'id');

        return view('web.user.index', compact('users', 'positions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $position = $request->position;
        $this->userRepository->pushCriteria(new NameCriteria($name))
            ->pushCriteria(new EmailCriteria($email))
            ->pushCriteria(new PositionCriteria($position));
        $users = $this->userRepository->paginate(setting('paginate'));

        return view('web.user.filter', compact('users'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function assignPermission($id)
    {
        abort_if(Auth::user()->cant('manage', User::class), 403);

        $user = $this->userRepository->find($id);
        $permissions = $this->permissionRepository->all();
        $permissionGroups = Permission::GROUPS;

        return view('web.user.assign_permission', compact('user', 'permissions', 'permissionGroups'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePermission(Request $request, $id)
    {
        abort_if(Auth::user()->cant('manage', User::class), 403);

        $user = $this->userRepository->find($id);

        if ($user->can('manage', User::class)) {
            $result = $user->permissions()->sync($this->permissionRepository->all()->pluck('id'));
        } else {
            $result = $user->permissions()->sync($request->permission);
        }

        if ($result) {
            return response()->json([trans('messages.success')]);
        }
        return response()->json([trans('messages.failure')], 500);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignManager($id)
    {
        abort_if(!Auth::user()->is_admin, 403);

        $user = $this->userRepository->find($id);
        if ($user->permissions()->toggle($this->permissionRepository->getManagePermission()->id)) {
            return response()->json([trans('messages.success')]);
        };

        if ($user->can('manage', User::class)) {
            $user->permissions()->sync($this->permissionRepository->all()->pluck('id'));
        }

        return response()->json([trans('messages.failure')], 500);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
