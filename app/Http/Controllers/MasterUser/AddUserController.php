<?php

namespace App\Http\Controllers\MasterUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddUserController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|file|max:2048',
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'position' => 'required|not_in:',
            'birthdate' => 'nullable',
            'phone' => 'nullable',
            'account_number' => 'nullable',
        ], [
            'name.unique' => 'Gagal disimpan, Nama sudah digunakan oleh pengguna lain.',
            'email.unique' => 'Gagal disimpan, Email sudah digunakan oleh pengguna lain.',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('position');
        $user->save();

        $userDetail = new UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->ud_address = $request->input('address');
        $userDetail->ud_phone = $request->input('phone');
        $userDetail->ud_birthday = $request->input('birthdate');
        $userDetail->ud_placeofbirth = $request->input('place_of_birth');
        $userDetail->ud_accountnumber = $request->input('account_number');
        $userDetail->ud_bank = $request->input('bank_name');
        $userDetail->ud_lasteducation = $request->input('education_level');
        $userDetail->ud_university = $request->input('university');
        $userDetail->ud_faculty = $request->input('faculty');
        $userDetail->ud_programstudy = $request->input('major');

        $gender = $request->input('gender');

        if ($gender === 'perempuan') {
            $userDetail->ud_gender = 0;
        } elseif ($gender === 'laki-laki') {
            $userDetail->ud_gender = 1;
        } else {
            $userDetail->ud_gender = null;
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('profile_photos', 'public');
            $userDetail->ud_photo = $imagePath;
        }

        $userDetail->save();

        return redirect()->route('masteruser')->with('success', 'User has been added successfully.');
    }
}
