<?php

namespace App\Http\Controllers\MasterUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class MasterUserController extends Controller
{
    public function index(){
        
        $users = User::latest();

        if (request('search')){
            $users->where('name', 'like', '%'.request('search').'%')
                ->orWhere('email', 'like', '%'.request('search').'%');
        }

        return view('masterpengguna.masteruser', ["users" => $users->get()]);
    }

    public function show(User $user)
    {
        $user->load('user_detail');
        return view('masterpengguna.detailuser', compact('user'));
    }

    public function edit(User $user)
    {
        return view('masterpengguna.edituser', ["user" => $user]);
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
