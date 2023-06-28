<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class MasterPenggunaController extends Controller
{
    public function index() {
        $users = User::where('role', '!=', '1')
                    ->orderBy('updated_at')
                    ->with('roles')
                    ->get();
        return view('masterpengguna.masteruser', compact('users'));
    }
}
