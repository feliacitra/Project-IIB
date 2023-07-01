<?php

namespace App\Http\Controllers\MasterUser;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request, User $user)
    {
        $userRules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ];

        $userDetailRules = [
            'ud_gender' => 'required',
            'ud_birthday' => 'required',
            'ud_phone' => 'required',
            'ud_address' => 'required',
            'ud_photo' => 'image|mimes:jpeg,png,jpg|file|max:2048',
        ];

        if($request->name != $user->name){
            $userRules['name'] = 'required|unique:users';
        }

        if($request->email != $user->email){
            $userRules['email'] = 'required|unique:users';
        }

        if($request->password != $user->password){
            $userRules['password'] = 'required|unique:users';
        }

        $validatedUserData = $request->validate($userRules);
        $validatedUserData['password'] = Hash::make($validatedUserData['password']);

        $validatedUserDetailData = $request->validate($userDetailRules);

        if ($user->user_detail->ud_photo != null) Storage::delete('public/' . $user->user_detail->ud_photo);

        if($request->file('ud_photo')){
            $validatedUserDetailData['ud_photo'] = $request->file('ud_photo')->store('profile_photos', 'public');
        }

        User::where('id', $user->id)->update($validatedUserData);
        UserDetail::where('ud_id', $user->user_detail->ud_id)->update($validatedUserDetailData);

        return redirect('/masteruser')->with('success', 'User has been editted');
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
