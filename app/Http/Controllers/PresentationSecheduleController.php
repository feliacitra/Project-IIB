<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresentationSecheduleController extends Controller
{
    public function index()
    {
        // $schedules = PresentationSchedule::all();
        return view('Pendaftaran-Presentasi.index');
    }
}
