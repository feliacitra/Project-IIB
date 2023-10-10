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
    public function index(Request $request){
        $pilihPeriode = '';
        $pilihStatus = '';
        $builder = MasterStartup::query();
        // dd($builder->with('registationStatus')->get());
        if ($request->has('pilihPeriode') && $request->pilihPeriode != 'select') {
            $pilihPeriode = request('pilihPeriode');
            $builder->whereHas('masterPeriodeProgram.masterPeriode', function ($query) use ($pilihPeriode) {
                $query->where('master_periode.mpe_id', 'like', '%' . $pilihPeriode . '%');
            });
        }

        if ($request->has('pilihStatus') && $request->pilihStatus != 'select') {
            $pilihStatus = request('pilihStatus');
            $builder->whereHas('registationStatus', function ($query) use ($pilihStatus) {
                $query->where('srt_status', $pilihStatus);
            });
        }

        if (request('search')){
            $search = request('search');
            $startup = MasterStartup::where('ms_name', 'like', '%' . $search . '%')
                ->orWhereHas('masterPeriodeProgram.masterPeriode.masterProgramInkubasi', function ($query) use ($search) {
                    $query->where('mpi_name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('masterPeriodeProgram.masterPeriode', function ($query) use ($search) {
                    $query->where('mpe_name', 'like', '%' . $search . '%');
                })->get();
        }
        
        // $mqDesk = StartupComponentStatus::with('registationAnswer')->
        // whereHas('registationAnswer',function($q){
            //     $q->where('user_id','=',auth()->user()->id);
            // })->get();
            
        $startup = $builder->with('masterPeriodeProgram', 'startupComponentStatus')->get();
        $periode = MasterPeriode::get();
        // dd($startup); 
        return view('Pendaftaran-PenilaianDE.penilaianDE', compact('startup', 'periode', 'pilihPeriode', 'pilihStatus'));
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
        $components = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')->where('mct_step', 1)->get();
        $componentDesk = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')->where('mct_step', 3)->where('mpd_id', $mc->periodeProgram->mpd_id)->first();

        $mqDesk = StartupComponentStatus::with('registationAnswer')
        ->where('ms_id',$component->ms_id)->get();

        // dd($mqDesk);
        // dd(auth()->user()->id);
        $masterKategori = MasterCategory::all();
        $universitas = MasterUniversitas::with('faculties', 'faculties.programStudy')->get();
        // $fakultas = MasterFakultas::all();
        // $prodi = MasterProgramStudy::all();
        $civitas = MasterCivitas::all();


        return view('Pendaftaran-PenilaianDE.nilaiEdit', compact('component', 'mc', 'masterKategori', 'universitas', 'civitas', 'components', 'componentDesk', 'mqDesk'));
       
    }

    public function update(Request $request, $id){
        // dd($request);
        
        $component = MasterStartup::with('startupComponentStatus',
        'masterPeriodeProgram',
        'masterPeriodeProgram.component.question.questionRange',
        'registationStatus',
        'startupComponentStatus.registationAnswer')->where('ms_id', $id)->first();
        
        $component->registationStatus->update(['srt_status' => $request->kelulusan]);
        $component->registationStatus->update(['srt_step' => 3]);

        $mqDesk = StartupComponentStatus::with('registationAnswer')
        ->where('ms_id',$component->ms_id)->get();
        
        // if allready updated
        if(!isset($mqDesk[1])){
            // count final score desk evaluation
            $score = 0;
            for($i =0; $i < count($request->deskAnswer); $i++){
                $point = MasterQuestionRange::where('mqr_id', $request->deskAnswer[$i])->get();
                $subset = $point->map(function($point){
                    return collect($point->toArray())->only(['mqr_poin'])->all();
                });
                $score += (int)$subset[0]["mqr_poin"];
            }
            $finalScore = (int)$score / (int)count($request->deskAnswer);
            
            
            $scs = StartupComponentStatus::create([
                'scs_notes' => $request->catatan,
                'ms_id' => $component->ms_id,
                'scs_totalscore' => $finalScore,
            ]);
            
            // registation answer desk 
            $question = $component->masterPeriodeProgram->component->where('mct_step',3)->where('mpd_id',$component->masterPeriodeProgram->mpd_id)->first();
            // dd($request->answer);
            for($i =0; $i < count($request->deskAnswer); $i++){
                // dd(MasterQuestionRange::where('mqr_id', $request->deskAnswer[$i])->first()->mqr_poin);
                RegistationAnswer::create([
                    'mq_id' => $question->question[$i]->id,
                    'mqr_id' => (int)$request->deskAnswer[$i],
                    'user_id' => auth()->user()->id,
                    'ra_score' => MasterQuestionRange::where('mqr_id', $request->deskAnswer[$i])->first()->mqr_poin,
                    'scs_id' => $scs->scs_id,
                ]);
            }
        }else{
            for($i=0; $i < count($mqDesk[1]->registationAnswer); $i++){
                // dd($request);
                    $mqDesk[1]->registationAnswer[$i]->update(['mqr_id' => $request->deskAnswer[$i]]);
                }

            $score = 0;
            for($i =0; $i < count($request->deskAnswer); $i++){
                $point = MasterQuestionRange::where('mqr_id', $request->deskAnswer[$i])->get();
                $subset = $point->map(function($point){
                    return collect($point->toArray())->only(['mqr_poin'])->all();
                });
                $score += (int)$subset[0]["mqr_poin"];
            }
            $finalScore = (int)$score / (int)count($request->deskAnswer);
                
            $mqDesk[1]->update(['scs_notes' => $request->catatan]);
            $mqDesk[1]->update(['scs_totalscore' => $finalScore]);     
        }

          
        
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
