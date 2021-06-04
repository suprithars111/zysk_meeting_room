<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMeetingRoom extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'meeting_room_type_id', 'url'];

    protected $searchableFields = ['*'];

    protected $table = 'user_meeting_rooms';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meetingRoomType()
    {
        return $this->belongsTo(MeetingRoomType::class);
    }
}
