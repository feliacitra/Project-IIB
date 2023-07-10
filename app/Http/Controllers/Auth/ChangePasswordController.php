<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{

    public function changePassword(Request $request){
        $validation = $request->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'min:8',
                'max:12',
                'regex:/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@$*(),.":])/',
                'confirmed',
            ],
            ]
        );

        // Check if password is match 
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->withErrors("Old Password is Wrong!");
        }

        // Check if new password is match with old one
        if($request->old_password == $request->password){
            return back()->withErrors("New Password Must Be Different From Your Old Password");
        }

        // Update Password
        User::whereId(auth()->user()->id)->update([
            'password' =>Hash::make($request->password)
        ]);

        return back()->with("success", "Successfully Changed Your Password");
    }

}
