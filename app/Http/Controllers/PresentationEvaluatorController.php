<?php

namespace App\Http\Controllers;

use App\Models\MasterComponent;
use App\Models\MasterPeriode;
use App\Models\MasterStartup;
use App\Models\PresentationSchedule;
use App\Models\StartupComponentStatus;
use App\Models\User;
use Illuminate\Http\Request;

class PresentationEvaluatorController extends Controller
{
    public function index(){

        $periode = MasterPeriode::all();
        $startup = MasterStartup::all();
        $user = User::where('role', '3')->get();

        $presentasi = PresentationSchedule::with('MasterPeriodeProgram.MasterPeriode', 'MasterStartup')->get();

        return view('Penilai.lihatJadwalPresentasi', compact('periode','startup','user','presentasi'));
    }

    public function show($id){
        $presentasi = PresentationSchedule::with('MasterPeriodeProgram.MasterPeriode', 'MasterStartup')
        ->where('ps_id', $id)->first();

        $componentDesk = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')
        ->where('mct_step', 2)->where('mpd_id', $presentasi->masterPeriodeProgram->mpd_id)->first();

        $mqDesk = StartupComponentStatus::with('registationAnswer')
        ->where('ms_id',$presentasi->masterStartup->ms_id)->get();
        // dd($componentDesk);

        


        return view('penilai.nilaiView', compact('presentasi', 'componentDesk', 'mqDesk'));

        
    }
}
