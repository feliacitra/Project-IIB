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
        if (request('search')){

            $search = request('search');
            $startup = MasterStartup::where('ms_name', 'like', '%' . $search . '%')
                ->orWhereHas('masterPeriodeProgram.masterPeriode.masterProgramInkubasi', function ($query) use ($search) {
                    $query->where('mpi_name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('masterPeriodeProgram.masterPeriode', function ($query) use ($search) {
                    $query->where('mpe_name', 'like', '%' . $search . '%');
                })->get();
        } else {
            // dd($periode);
            $startup = MasterStartup::with('masterPeriodeProgram', 'startupComponentStatus')->get();
        }
        
        
        $periode = MasterPeriode::get();
        return view('Pendaftaran-PenilaianDE.penilaianDE', compact('startup', 'periode'));
    }
    
    public function show($id){
        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer')->where('ms_id', $id)->first();
        
        $mct = $component->masterPeriodeProgram->component[0]->mct_id;
        $mc = MasterComponent::with('question', 'question.questionRange', 'periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')->where('mct_id', $mct)->first();

        return view('Pendaftaran-PenilaianDE.nilaiView', compact('component', 'mc'));
        
    }

    public function edit($id){
        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer')->where('ms_id', $id)->first();

        $mct = $component->masterPeriodeProgram->component[0]->mct_id;
        $mc = MasterComponent::with('question', 'question.questionRange', 'periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')->where('mct_id', $mct)->first();
        // dd($question);
        // dd($mc);
        return view('Pendaftaran-PenilaianDE.nilaiEdit', compact('component', 'mc' ));
       
    }

    public function update(Request $request, $id){

        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer')->where('ms_id', $id)->first();

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
