<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{

    public function changePassword(Request $request){

        // Check if new password match with confirm password
        if($request->new_password != $request->new_password_confirm){
            return back()->with("error", "Password and Confirm Password Doesn't match!");
        }

        // Check if password is match 
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

        // Update Password
        User::whereId(auth()->user()->id)->update([
            'password' =>Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password Changed Successfully");
    }

}
