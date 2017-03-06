<?php
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory(User::class, 10)->create();
        User::whereId(1)->update([
            'name' => 'Manager',
            'email' => 'manager@frsm.com',
            'position_id' => 1,
        ]);
        User::whereId(2)->update([
            'name' => 'Trainer PHP',
            'email' => 'trainer@frsm.com',
            'position_id' => 2,
        ]);
        User::whereId(3)->update([
            'name' => 'HR',
            'email' => 'hr@frsm.com',
            'position_id' => 3,
        ]);
        User::whereId(4)->update([
            'name' => 'admin',
            'email' => 'admin@frsm.com',
            'position_id' => 1,
            'is_admin' => true,
        ]);

    }
}
