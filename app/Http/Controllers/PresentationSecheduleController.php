<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterPeriode;
use App\Models\MasterStartup;
use App\Models\User;

class PresentationSecheduleController extends Controller
{
    public function index()
    {
        $periode = MasterPeriode::all();
        $startup = MasterStartup::all();
        $user = User::where('role', '3')->get();

        return view('Pendaftaran-KelolaJadwalPresentasi.listJadwalPresentasi', compact('periode', 'startup', 'user'));
    }
}
