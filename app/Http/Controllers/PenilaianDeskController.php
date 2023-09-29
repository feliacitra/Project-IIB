<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use App\Models\MasterCivitas;
use App\Models\MasterComponent;
use App\Models\MasterFakultas;
use App\Models\MasterMember;
use App\Models\MasterPeriode;
use App\Models\MasterPeriodeProgram;
use App\Models\MasterProgramInkubasi;
use App\Models\MasterProgramStudy;
use App\Models\MasterQuestion;
use App\Models\MasterQuestionRange;
use App\Models\MasterStartup;
use App\Models\MasterUniversitas;
use App\Models\RegistationAnswer;
use App\Models\RegistationStatus;
use App\Models\StartupComponentStatus;
use App\Models\User;
use App\Notifications\PendaftaranStartupNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // $member = MasterMember::with('civitas')->get();
        
        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer',
        'masterMember.civitas',
        'masterMember.universitas',
        'masterMember.fakultas',
        'masterMember.prodi')->where('ms_id', $id)->first();
        // dd($component);

        $mct = $component->masterPeriodeProgram->component[0]->mct_id;
        $mc = MasterComponent::with('question', 'question.questionRange', 'periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')->where('mct_id', $mct)->first();
        $components = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')->get();
        // dd($components);
        $masterKategori = MasterCategory::all();
        $universitas = MasterUniversitas::with('faculties', 'faculties.programStudy')->get();
        // $fakultas = MasterFakultas::all();
        // $prodi = MasterProgramStudy::all();
        $civitas = MasterCivitas::all();


        return view('Pendaftaran-PenilaianDE.nilaiEdit', compact('component', 'mc', 'masterKategori', 'universitas', 'civitas', 'components'));
       
    }

    public function update(Request $request, $id){
        // dd($request);

        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer')->where('ms_id', $id)->first();

        $component->registationStatus->update(['srt_status' => $request->kelulusan]);
        $component->registationStatus->update(['srt-step' => 2]);

        
        // // registation answer
        // for($i =0; $i < count($component->StartupComponentStatus->registationAnswer); $i++){
        //     $component->StartupComponentStatus->registationAnswer[$i]->update(['mqr_id' => $request->answer[$i]]);
        // }
        
        // // update final score
        // $score = 0;
        // for($i =0; $i < count($request->answer); $i++){
        //     $point = MasterQuestionRange::where('mqr_id', $request->answer[$i])->get();
        //     $subset = $point->map(function($point){
        //         return collect($point->toArray())->only(['mqr_poin'])->all();
        //     });
        //     $score += (int)$subset[0]["mqr_poin"];
        // }
        // $finalScore = (int)$score / (int)count($request->answer);

        // $component->startupComponentStatus->update(['scs_notes' => $request->catatan]);
        // $component->startupComponentStatus->update(['scs_totalscore' => $finalScore]);        
        
        $user = User::where('id',$component->user_id)->first();
        if($request->kelulusan == "Lulus"){
            $user->notify(new PendaftaranStartupNotification($user, 'Selamat Anda Lulus Ke Tahap Berikutnya!'));
        }else{
            $user->notify(new PendaftaranStartupNotification($user, 'Anda Tidak Lulus Ke Tahap Berikutnya'));
        }
        

        return redirect()->route('penilaianDE');
    }

    public function download(Request $request){
        // dd($request);
        if (Storage::disk('public')->exists("$request->ms_pitchdeck")){
            
        }
    }
}
