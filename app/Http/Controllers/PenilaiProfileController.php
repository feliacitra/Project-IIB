<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenilaiProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('Penilai.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $userRules = [
            'name' => 'required',
            'email' => 'required',
        ];

        $userDetailRules = [
            'gender' => 'required',
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
            if($user->user_detail->ud_photo){
                Storage::delete('public/'.$user->user_detail->ud_photo);
            }

            $validatedUserDetailData['image'] = $request->file('image')->store('profile_photos','public');
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

        return redirect('/penilai/profil')->with('success', 'Profil telah diedit');
    }
}
