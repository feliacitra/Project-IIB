<?php

namespace App\Http\Controllers;

use App\Models\MasterComponent;
use App\Models\MasterPeriode;
use App\Models\MasterQuestionRange;
use App\Models\MasterStartup;
use App\Models\PresentationEvaluator;
use App\Models\PresentationSchedule;
use App\Models\RegistationAnswer;
use App\Models\RegistationStatus;
use App\Models\StartupComponentStatus;
use App\Models\User;
use App\Notifications\PendaftaranStartupNotification;
use Illuminate\Http\Request;


class PresentationEvaluatorController extends Controller
{
    public function index(){

        $periode = MasterPeriode::all();
        $startup = MasterStartup::all();
        $user = User::where('role', '3')->get();

        $presentasi = PresentationSchedule::with('MasterPeriodeProgram.MasterPeriode', 'MasterStartup')->get();
        
        // $mqDesk = StartupComponentStatus::with('registationAnswer')
        // ->where('ms_id',$presentasi->masterStartup->ms_id)->get();

        return view('Penilai.lihatJadwalPresentasi', compact('periode','startup','user','presentasi',));
    }

    public function show($id){
        $presentasi = PresentationSchedule::with('MasterPeriodeProgram.MasterPeriode', 'MasterStartup')
        ->where('ps_id', $id)->first();

        $componentDesk = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')
        ->where('mct_step', 2)->where('mpd_id', $presentasi->masterPeriodeProgram->mpd_id)->first();

        $mqDesk = StartupComponentStatus::with('registationAnswer')
        ->where('ms_id',$presentasi->masterStartup->ms_id)->get();

        return view('penilai.nilaiView', compact('presentasi', 'componentDesk', 'mqDesk'));
    }

    public function edit($id){

        $presentasi = PresentationSchedule::with('MasterPeriodeProgram.MasterPeriode', 'MasterStartup')
        ->where('ps_id', $id)->first();

        $componentDesk = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')
        ->where('mct_step', 2)->where('mpd_id', $presentasi->masterPeriodeProgram->mpd_id)->first();

        $mqDesk = StartupComponentStatus::with('registationAnswer')
        ->where('ms_id',$presentasi->masterStartup->ms_id)->get();

        return view('penilai.nilaiEdit', compact('presentasi', 'componentDesk', 'mqDesk'));
    }

    public function update(Request $request, $id){
        // dd($request);

        
        $presentasi = PresentationSchedule::with('MasterPeriodeProgram.MasterPeriode', 'MasterStartup')
        ->where('ps_id', $id)->first();

        $mqDesk = StartupComponentStatus::with('registationAnswer')
        ->where('ms_id',$presentasi->masterStartup->ms_id)->get();

        if(!isset($mqDesk[2])){
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
                'ms_id' => $presentasi->masterStartup->ms_id,
                'scs_totalscore' => $finalScore,
            ]);
            
            // registation answer desk 
            $question = $presentasi->masterPeriodeProgram->component->where('mct_step',2)->where('mpd_id',$presentasi->masterPeriodeProgram->mpd_id)->first();
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

            PresentationEvaluator::create([
                'ps_id'=> $presentasi->ps_id,
                'user_id'=>auth()->user()->id,
                'scs_id'=>  $scs->scs_id,
            ]);

            RegistationStatus::create([
                'ms_id' => $presentasi->masterStartup->ms_id,
                'srt_step' => 2,
                'srt_status' => $request->kelulusan,
            ]);
        }else{
            for($i=0; $i < count($mqDesk[2]->registationAnswer); $i++){
                // dd($request);
                    $mqDesk[2]->registationAnswer[$i]->update(['mqr_id' => $request->deskAnswer[$i]]);
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
                
            $mqDesk[2]->update(['scs_notes' => $request->catatan]);
            $mqDesk[2]->update(['scs_totalscore' => $finalScore]);   

            $presentasi->masterStartup->registationStatus[1]->update(['srt_status' => $request->kelulusan]);
            $presentasi->masterStartup->registationStatus[1]->update(['srt_step' => 2]);
        }

        $user = User::where('id',$presentasi->masterStartup->user_id)->first();
        if($request->kelulusan == "Lulus"){
            $user->notify(new PendaftaranStartupNotification($user, 'Selamat Anda Lulus Tahap Presentasi!'));
        }else{
            $user->notify(new PendaftaranStartupNotification($user, 'Anda Tidak Lulus Tahap Presentasi'));
        }

            

            return redirect(route('lihatjadwalpresentasi'));
        }
}