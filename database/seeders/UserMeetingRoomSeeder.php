<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserMeetingRoom;

class UserMeetingRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserMeetingRoom::factory()
            ->count(5)
            ->create();
    }
}
