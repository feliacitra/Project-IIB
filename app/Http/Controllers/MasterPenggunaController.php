<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MasterPenggunaController extends Controller
{
    public function index() {
        $users = User::latest('updated_at')
                    ->with('roles')
                    ->get();
        
        $role = Auth::user()->role;
        $features = Role::find($role)->features;
        return view('Master-Pengguna.listUser', compact('users', 'features'));
    }

    public function create()
    {
        return view('Master-Pengguna.adduser');
    }

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
            'name.unique' => 'Gagal disimpan, Nama sudah digunakan oleh peserta lain.',
            'email.unique' => 'Gagal disimpan, Email sudah digunakan oleh peserta lain.',
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

        return redirect()->route('master.pengguna')->with('success', 'User has been added successfully.');
    }

    public function show(User $user)
    {
        $user->load('user_detail');
        return view('Master-Pengguna.detailuser', compact('user'));
    }

    public function edit(User $user)
    {
        return view('Master-Pengguna.edituser', ["user" => $user]);
    }

    public function update(Request $request, User $user)
    {
        $userRules = [
            'name' => 'required',
            'email' => 'required',
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

        if($request->input('name') != $user->name){
            $userRules['name'] = 'required|unique:users';
        }

        if($request->input('email') != $user->email){
            $userRules['email'] = 'required|unique:users';
        }

        $validatedUserData = $request->validate($userRules);

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

        return redirect()->route('master.pengguna')->with('success', 'User has been editted');
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
