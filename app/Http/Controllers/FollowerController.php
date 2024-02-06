<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class FollowerController extends Controller
{
    //

    public function follow(User $user)
    {
        $follower = auth()->user();

        $user->followers()->attach($follower);

        return redirect()->route('users.show' , $user->id)->with('success' , 'User Followed Successfully!');
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();

        $user->followings()->detach($follower);

        return redirect()->route('users.show' , $user->id)->with('success' , 'User UnFollowed Successfully!');
    }
}
