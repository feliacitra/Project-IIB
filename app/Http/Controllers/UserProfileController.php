<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index(User $user) {
        $user->load('user_detail');
        return view('profile.detailProfile', compact('user'));
    }
    
    public function edit(User $user)
    {
        return view('profile.editProfile', ["user" => $user]);
    }

    public function update(Request $request, User $user)
    {
        $userRules = [
            'name' => 'required',
            'email' => 'required',
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

        if($request->input('name') != $user->name){
            $userRules['name'] = 'required|unique:users';
        }

        if($request->input('email') != $user->email){
            $userRules['email'] = 'required|unique:users';
        }

        $validatedUserData = $request->validate($userRules);

        $validatedUserDetailData = $request->validate($userDetailRules);

        if($request->file('image')){
            
            if ($user->user_detail) {
                if ($user->user_detail->ud_photo) Storage::delete('public/' . $user->user_detail->ud_photo);
            }

            $validatedUserDetailData['image'] = $request->file('image')->store('profile_photos', 'public');
        }

        User::where('id', $user->id)->update($validatedUserData);
        UserDetail::updateOrCreate(['user_id' => $user->id], [
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
        
        if (array_key_exists('image', $validatedUserDetailData)) {
            UserDetail::where('user_id', $user->id)->update([
                'ud_photo' => $validatedUserDetailData['image']
            ]);
        }
        // return redirect()->route('edit-profile', $user)->with('success', 'User has been editted');
        return redirect('/edit/profile/'.$request->name)->with('success', 'User has been editted');
    }

}
