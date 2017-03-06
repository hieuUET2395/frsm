<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\PositionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\PositionRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\ScheduleRepository;
use App\Repositories\Contracts\ScheduleRepositoryInterface;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Eloquent\FieldRepository;
use App\Repositories\Contracts\FieldRepositoryInterface;
use App\Repositories\Contracts\CandidateRepositoryInterface;
use App\Repositories\Eloquent\CandidateRepository;
use App\Repositories\Contracts\MessageRepositoryInterface;
use App\Repositories\Eloquent\MessageRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(PositionRepositoryInterface::class, PositionRepository::class);
        App::bind(SettingRepositoryInterface::class, SettingRepository::class);
        App::bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        App::bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        App::bind(FieldRepositoryInterface::class, FieldRepository::class);
        App::bind(CandidateRepositoryInterface::class, CandidateRepository::class);
        App::bind(MessageRepositoryInterface::class, MessageRepository::class);
    }
}
