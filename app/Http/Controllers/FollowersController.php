<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FollowersController extends Controller
{
    public function follow(User $currentUser, User $user)
    {
        return $currentUser->id !== $user->id;
    }

    public function store(User $user)
    {
        $this->authorize('follow', $user);

        if ( ! Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $this->authorize('follow', $user);

        if ( Auth::user()->isFollowing($user->id)){
            Auth::user()->unfollow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }
}
