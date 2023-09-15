<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use App\Models\MasterComponent;
use App\Models\MasterPeriode;
use App\Models\MasterPeriodeProgram;
use App\Models\MasterProgramInkubasi;
use App\Models\MasterQuestion;
use App\Models\MasterQuestionRange;
use App\Models\MasterStartup;
use App\Models\RegistationAnswer;
use App\Models\RegistationStatus;
use App\Models\StartupComponentStatus;
use Illuminate\Http\Request;

class PenilaianDeskController extends Controller
{
    public function index(){
        $kategori = MasterCategory::all();
        $startup = MasterStartup::with('masterPeriodeProgram', 'startupComponentStatus')->get();

        // dd(StartupComponentStatus::with('registationAnswer')->get());

        return view('Pendaftaran-PenilaianDE.penilaianDE', compact('kategori', 'startup'));
    }
    
    public function show($id){
        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer')->where('ms_id', $id)->first();
        $question = MasterQuestion::with('questionRange')->get();
        return view('Pendaftaran-PenilaianDE.nilaiView', compact('component', 'question'));
    }

    public function edit($id){
        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer')->where('ms_id', $id)->first();

        // $questionRange = MasterQuestionRange::with('question')->get();
        $question = MasterQuestion::with('questionRange')->get();
        return view('Pendaftaran-PenilaianDE.nilaiEdit', compact('component', 'question'));
    }

    public function update($id, Request $request){
        
        $component = MasterStartup::with('registationStatus', 'startupComponentStatus.registationAnswer' )->where('ms_id', $id)->first();
        $component->registationStatus->update(['srt_status' => $request->kelulusan]);
        $component->registationStatus->update(['srt-step' => 2]);

        
        // registation answer
        for($i =0; $i < count($component->StartupComponentStatus->registationAnswer); $i++){
            $component->StartupComponentStatus->registationAnswer[$i]->update(['mqr_id' => $request->answer[$i]]);
        }
        
        // update final score
        $score = 0;
        for($i =0; $i < count($request->answer); $i++){
            $point = MasterQuestionRange::where('mqr_id', $request->answer[$i])->get();
            $subset = $point->map(function($point){
                return collect($point->toArray())->only(['mqr_poin'])->all();
            });
            $score += (int)$subset[0]["mqr_poin"];
        }
        $finalScore = (int)$score / (int)count($request->answer);

        $component->startupComponentStatus->update(['scs_notes' => $request->catatan]);
        $component->startupComponentStatus->update(['scs_totalscore' => $finalScore]);        
        
        return redirect()->route('penilaianDE');
    }
}
