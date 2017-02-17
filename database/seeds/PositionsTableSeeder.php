<?php

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::truncate();
        DB::table('positions')->insert([
            [
                'name' => 'Manager',
                'type' => 'user',
            ],
            [
                'name' => 'Trainer PHP',
                'type' => 'user',
            ],
            [
                'name' => 'HR',
                'type' => 'user',
            ],
            [
                'name' => 'trainer PHP',
                'type' => 'candidate',
            ],
            [
                'name' => 'Intern PHP',
                'type' => 'candidate'
            ],
            [
                'name' => 'Intern Ruby',
                'type' => 'candidate'
            ],
            [
                'name' => 'QA',
                'type' => 'candidate'
            ],
            [
                'name' => 'New Dev Android',
                'type' => 'candidate'
            ],
            [
                'name' => 'New Dev iOS',
                'type' => 'candidate'
            ],
        ]);
    }
}
