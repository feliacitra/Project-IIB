<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use App\Models\MasterCivitas;
use App\Models\MasterComponent;
use App\Models\MasterMember;
use App\Models\MasterStartup;
use App\Models\MasterUniversitas;
use App\Models\StartupComponentStatus;
use App\Models\MasterPeriode;
use Illuminate\Http\Request;


class DataPendaftarController extends Controller
{
    public function index(){
        if (request('search')){
            // dd(request('search'));
            $member = MasterMember::with('masterStartup.masterPeriodeProgram.masterPeriode',
            'masterStartup.masterPeriodeProgram.masterProgramInkubasi',
            'masterStartup.masterCategory',
            'masterStartup.registationStatus',
            'masterStartup.startupComponentStatus')->where('mm_name', 'like', '%' . request('search') . '%')->
            orWhereHas('masterStartup', function($q){
                $q->where('ms_name', 'like', '%' . request('search') . '%');
            })->get();
        }elseif(request('periode')){
            $member = MasterMember::with('masterStartup.masterPeriodeProgram.masterPeriode',
            'masterStartup.masterPeriodeProgram.masterProgramInkubasi',
            'masterStartup.masterCategory',
            'masterStartup.registationStatus',
            'masterStartup.startupComponentStatus')->whereHas('masterStartup', function($q){
                $q->whereHas('masterPeriodeProgram', function($q){
                    $q->where('mpe_id', request('periode'));
                });
            })->get();
        }elseif(request('status')){
            $member = MasterMember::with('masterStartup.masterPeriodeProgram.masterPeriode',
            'masterStartup.masterPeriodeProgram.masterProgramInkubasi',
            'masterStartup.masterCategory',
            'masterStartup.registationStatus',
            'masterStartup.startupComponentStatus')->whereHas('masterStartup', function($q){
                $q->whereHas('registationStatus', function($q){
                    $q->where('srt_status', request('status'));
                });
            })->get();
            $startup = MasterStartup::with('masterPeriodeProgram', 'startupComponentStatus', 'registationStatus')
            ->wherehas('registationStatus', function($q){
                $q->where('srt_status', request('status'));
            })->get();
        }
        else{
            // dd($periode);
            $member = MasterMember::with('masterStartup.masterPeriodeProgram.masterPeriode',
            'masterStartup.masterPeriodeProgram.masterProgramInkubasi',
            'masterStartup.masterCategory',
            'masterStartup.registationStatus',
            'masterStartup.startupComponentStatus')->get();
        }
        
        
        // dd($member);
      
        $periode = MasterPeriode::get();
        return view('Pendaftaran-DataPendaftar.dataPendaftar', compact('member', 'periode'));

    }

    public function show($id){

        $member = MasterMember::with('civitas', 'universitas', 'fakultas', 'prodi')
        ->where('mm_id', $id)->first();

          
        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer',
        'masterMember.civitas',
        'masterMember.universitas',
        'masterMember.fakultas',
        'masterMember.prodi')->where('ms_id', $member->ms_id )->first();
        
        $mct = $component->masterPeriodeProgram->component[0]->mct_id;
        $mc = MasterComponent::with('question', 'question.questionRange', 'periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')->where('mct_id', $mct)->first();
        $components = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')->where('mct_step', 1)->get();
        $componentDesk = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')->where('mct_step', 3)->where('mpd_id', $mc->periodeProgram->mpd_id)->first();

        $mqDesk = StartupComponentStatus::with('registationAnswer')
        ->where('ms_id',$component->ms_id)->get();

        
        // dd($mqDesk);
        $masterKategori = MasterCategory::all();
        $universitas = MasterUniversitas::with('faculties', 'faculties.programStudy')->get();
        // $fakultas = MasterFakultas::all();
        // $prodi = MasterProgramStudy::all();
        $civitas = MasterCivitas::all();

        return view('Pendaftaran-DataPendaftar.dataStartup', compact('member', 'component','mc', 'masterKategori', 'universitas', 'civitas', 'components', 'componentDesk', 'mqDesk'));
    }
}
