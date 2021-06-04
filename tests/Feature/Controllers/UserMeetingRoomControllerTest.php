<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\UserMeetingRoom;

use App\Models\MeetingRoomType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserMeetingRoomControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_user_meeting_rooms()
    {
        $userMeetingRooms = UserMeetingRoom::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('user-meeting-rooms.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.user_meeting_rooms.index')
            ->assertViewHas('userMeetingRooms');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_user_meeting_room()
    {
        $response = $this->get(route('user-meeting-rooms.create'));

        $response->assertOk()->assertViewIs('app.user_meeting_rooms.create');
    }

    /**
     * @test
     */
    public function it_stores_the_user_meeting_room()
    {
        $data = UserMeetingRoom::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('user-meeting-rooms.store'), $data);

        $this->assertDatabaseHas('user_meeting_rooms', $data);

        $userMeetingRoom = UserMeetingRoom::latest('id')->first();

        $response->assertRedirect(
            route('user-meeting-rooms.edit', $userMeetingRoom)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_user_meeting_room()
    {
        $userMeetingRoom = UserMeetingRoom::factory()->create();

        $response = $this->get(
            route('user-meeting-rooms.show', $userMeetingRoom)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.user_meeting_rooms.show')
            ->assertViewHas('userMeetingRoom');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_user_meeting_room()
    {
        $userMeetingRoom = UserMeetingRoom::factory()->create();

        $response = $this->get(
            route('user-meeting-rooms.edit', $userMeetingRoom)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.user_meeting_rooms.edit')
            ->assertViewHas('userMeetingRoom');
    }

    /**
     * @test
     */
    public function it_updates_the_user_meeting_room()
    {
        $userMeetingRoom = UserMeetingRoom::factory()->create();

        $user = User::factory()->create();
        $meetingRoomType = MeetingRoomType::factory()->create();

        $data = [
            'url' => $this->faker->url,
            'user_id' => $user->id,
            'meeting_room_type_id' => $meetingRoomType->id,
        ];

        $response = $this->put(
            route('user-meeting-rooms.update', $userMeetingRoom),
            $data
        );

        $data['id'] = $userMeetingRoom->id;

        $this->assertDatabaseHas('user_meeting_rooms', $data);

        $response->assertRedirect(
            route('user-meeting-rooms.edit', $userMeetingRoom)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_user_meeting_room()
    {
        $userMeetingRoom = UserMeetingRoom::factory()->create();

        $response = $this->delete(
            route('user-meeting-rooms.destroy', $userMeetingRoom)
        );

        $response->assertRedirect(route('user-meeting-rooms.index'));

        $this->assertDeleted($userMeetingRoom);
    }
}
