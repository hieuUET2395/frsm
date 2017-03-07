<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;

class SettingRepository extends Repository implements SettingRepositoryInterface
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Setting::class;
    }
}
