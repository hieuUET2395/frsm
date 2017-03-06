<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FieldsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(RoundsTableSeeder::class);
        $this->call(FieldScheduleTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        factory(App\Models\Candidate::class, 3)->create()->each(function ($u) {
            $u->schedules()->save(factory(App\Models\Schedule::class)->create());
        });
    }
}
