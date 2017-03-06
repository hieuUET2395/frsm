<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        factory(Permission::class, 10)->create();
        Permission::whereId(1)->update([
            'name' => 'manage',
            'group_id' => 0,
        ]);
        Permission::whereId(2)->update([
            'name' => 'create user',
            'group_id' => 1,
        ]);
        Permission::whereId(3)->update([
            'name' => 'update user',
            'group_id' =>1,
        ]);
        Permission::whereId(4)->update([
            'name' => 'interview',
            'group_id' => 3,
        ]);
        Permission::whereId(5)->update([
            'name' => 'create candidate',
            'group_id' => 2,
        ]);
        Permission::whereId(6)->update([
            'name' => 'list user',
            'group_id' => 1,
        ]);
    }
}
