<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserMeetingRoom;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserMeetingRoomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the userMeetingRoom can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list usermeetingrooms');
    }

    /**
     * Determine whether the userMeetingRoom can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\UserMeetingRoom  $model
     * @return mixed
     */
    public function view(User $user, UserMeetingRoom $model)
    {
        return $user->hasPermissionTo('view usermeetingrooms');
    }

    /**
     * Determine whether the userMeetingRoom can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create usermeetingrooms');
    }

    /**
     * Determine whether the userMeetingRoom can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\UserMeetingRoom  $model
     * @return mixed
     */
    public function update(User $user, UserMeetingRoom $model)
    {
        return $user->hasPermissionTo('update usermeetingrooms');
    }

    /**
     * Determine whether the userMeetingRoom can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\UserMeetingRoom  $model
     * @return mixed
     */
    public function delete(User $user, UserMeetingRoom $model)
    {
        return $user->hasPermissionTo('delete usermeetingrooms');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\UserMeetingRoom  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete usermeetingrooms');
    }

    /**
     * Determine whether the userMeetingRoom can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\UserMeetingRoom  $model
     * @return mixed
     */
    public function restore(User $user, UserMeetingRoom $model)
    {
        return false;
    }

    /**
     * Determine whether the userMeetingRoom can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\UserMeetingRoom  $model
     * @return mixed
     */
    public function forceDelete(User $user, UserMeetingRoom $model)
    {
        return false;
    }
}
