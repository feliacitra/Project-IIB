<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenilaianDeskController extends Controller
{
    public function index(){
        return view('Pendaftaran-PenilaianDE.penilaianDE');
    }
}
