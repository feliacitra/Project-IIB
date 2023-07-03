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
        // $users = User::all();
        $users = User::where('role', '!=', '1')
                    ->orderBy('updated_at')
                    ->with('roles')
                    ->get();
        
        // $users = User::latest();

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
            'gender' => 'nullable',
            'birthdate' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg|file|max:2048',
            'place_of_birth' => 'nullable',
            'account_number' => 'nullable',
            'bank_name' => 'nullable',
            'education_level' => 'nullable',
            'university' => 'nullable',
            'faculty' => 'nullable',
            'major' => 'nullable',
        ];

        if($request->name != $user->name){
            $userRules['name'] = 'required|unique:users';
        }

        if($request->email != $user->email){
            $userRules['email'] = 'required|unique:users';
        }

        $validatedUserData = $request->validate($userRules);
        $validatedUserData['password'] = Hash::make($validatedUserData['password']);

        $validatedUserDetailData = $request->validate($userDetailRules);

        if($request->file('image')){
            
            if ($user->user_detail->ud_photo != null) Storage::delete('public/' . $user->user_detail->ud_photo);

            $validatedUserDetailData['image'] = $request->file('image')->store('profile_photos', 'public');
        }

        User::where('id', $user->id)->update($validatedUserData);
        UserDetail::where('ud_id', $user->user_detail->ud_id)->update([
            'ud_photo' => $validatedUserDetailData['image'] ?? $user->user_detail->ud_photo,
            'ud_address' => $validatedUserDetailData['address'],
            'ud_gender' => $validatedUserDetailData['gender'] ?? null,
            'ud_phone' => $validatedUserDetailData['phone'],
            'ud_birthday' => $validatedUserDetailData['birthdate'],
            'ud_placeofbirth' => $validatedUserDetailData['place_of_birth'],
            'ud_accountnumber' => $validatedUserDetailData['account_number'],
            'ud_bank' => $validatedUserDetailData['bank_name'],
            'ud_lasteducation' => $validatedUserDetailData['education_level'],
            'ud_university' => $validatedUserDetailData['university'],
            'ud_faculty' => $validatedUserDetailData['faculty'],
            'ud_programstudy' => $validatedUserDetailData['major'],
        ]);

        return redirect('/masteruser')->with('success', 'User has been editted');
    }

    public function destroy(User $user)
    {
        // User is deleting their own account
        if ($user->id === auth()->id()) {
            auth()->logout(); // Logout the user
        }

        // Delete the user's photo profile
        if ($user->user_detail->ud_photo) Storage::delete('public/' . $user->user_detail->ud_photo);
        
        // Delete the user
        $user->delete();

        // Flash success message
        Session::flash('success', 'User deleted successfully');

        // Redirect back or to a different route
        if (auth()->check()) {
            return redirect()->back();
        } else {
            return redirect('/login');
        }
    }
}
