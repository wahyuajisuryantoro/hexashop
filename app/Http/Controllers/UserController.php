<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $title = "Profile";
        $user = Auth::user();
        $userProfile = $user->userProfile;
        return view('pages.profile', compact('user', 'userProfile', 'title'));
    }


}