<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\UserMeetingRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMeetingRoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMeetingRoom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'user_id' => \App\Models\User::factory(),
            'meeting_room_type_id' => \App\Models\MeetingRoomType::factory(),
        ];
    }
}
