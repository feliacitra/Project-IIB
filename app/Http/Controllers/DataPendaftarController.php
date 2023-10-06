<?php

namespace App\Http\Controllers;

use App\Models\MasterMember;
use Illuminate\Http\Request;

class DataPendaftarController extends Controller
{
    public function index(){
        $member = MasterMember::with('masterStartup.masterPeriodeProgram.masterPeriode',
        'masterStartup.masterPeriodeProgram.masterProgramInkubasi',
        'masterStartup.masterCategory',
        'masterStartup.registationStatus',
        'masterStartup.startupComponentStatus')->get();
        // dd($member);
        
        return view('Pendaftaran-DataPendaftar.dataPendaftar', compact('member'));

    }

    public function show($id){

        $member = MasterMember::with('civitas', 'universitas', 'fakultas', 'prodi')
        ->where('mm_id', $id)->first();

        return view('Pendaftaran-DataPendaftar.dataStartup', compact('member'));
    }
}
