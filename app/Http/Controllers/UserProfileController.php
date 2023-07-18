<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserProfileController extends Controller
{
    public function index(User $user) {
        $user->load('user_detail');
        return view('profile.detailProfile', compact('user'));
    }

}
