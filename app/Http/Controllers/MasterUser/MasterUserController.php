<?php

namespace App\Http\Controllers\MasterUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class MasterUserController extends Controller
{
    public function index(){
        $users = User::all();

        return view('masterpengguna.masteruser', compact('users'))->with('user', $users->first());
    }

    public function show(User $user)
    {
        $user->load('user_detail');
        return view('masterpengguna.detailuser', compact('user'));
    }

    public function edit(User $user)
    {
        return view('masterpengguna.edituser', compact('user'));
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Flash success message
        Session::flash('success', 'User deleted successfully');

        // Redirect back or to a different route
        return redirect()->back();
    }
}
