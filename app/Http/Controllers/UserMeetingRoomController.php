<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserMeetingRoom;
use App\Models\MeetingRoomType;
use App\Http\Requests\UserMeetingRoomStoreRequest;
use App\Http\Requests\UserMeetingRoomUpdateRequest;

class UserMeetingRoomController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', UserMeetingRoom::class);

        $search = $request->get('search', '');

        $userMeetingRooms = UserMeetingRoom::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.user_meeting_rooms.index',
            compact('userMeetingRooms', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', UserMeetingRoom::class);

        $users = User::pluck('name', 'id');
        $meetingRoomTypes = MeetingRoomType::pluck('name', 'id');

        return view(
            'app.user_meeting_rooms.create',
            compact('users', 'meetingRoomTypes')
        );
    }

    /**
     * @param \App\Http\Requests\UserMeetingRoomStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserMeetingRoomStoreRequest $request)
    {
        $this->authorize('create', UserMeetingRoom::class);

        $validated = $request->validated();

        $userMeetingRoom = UserMeetingRoom::create($validated);

        return redirect()
            ->route('user-meeting-rooms.edit', $userMeetingRoom)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserMeetingRoom $userMeetingRoom
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserMeetingRoom $userMeetingRoom)
    {
        $this->authorize('view', $userMeetingRoom);

        return view('app.user_meeting_rooms.show', compact('userMeetingRoom'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserMeetingRoom $userMeetingRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserMeetingRoom $userMeetingRoom)
    {
        $this->authorize('update', $userMeetingRoom);

        $users = User::pluck('name', 'id');
        $meetingRoomTypes = MeetingRoomType::pluck('name', 'id');

        return view(
            'app.user_meeting_rooms.edit',
            compact('userMeetingRoom', 'users', 'meetingRoomTypes')
        );
    }

    /**
     * @param \App\Http\Requests\UserMeetingRoomUpdateRequest $request
     * @param \App\Models\UserMeetingRoom $userMeetingRoom
     * @return \Illuminate\Http\Response
     */
    public function update(
        UserMeetingRoomUpdateRequest $request,
        UserMeetingRoom $userMeetingRoom
    ) {
        $this->authorize('update', $userMeetingRoom);

        $validated = $request->validated();

        $userMeetingRoom->update($validated);

        return redirect()
            ->route('user-meeting-rooms.edit', $userMeetingRoom)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserMeetingRoom $userMeetingRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserMeetingRoom $userMeetingRoom)
    {
        $this->authorize('delete', $userMeetingRoom);

        $userMeetingRoom->delete();

        return redirect()
            ->route('user-meeting-rooms.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
