<?php

namespace App\Http\Controllers;

use App\Models\HistoryStartup;
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
use Carbon\Carbon;
use Illuminate\Http\Request;

class StartupController extends Controller
{
    public function index(){
        $periode = MasterPeriode::with('masterPeriodeProgram','masterProgramInkubasi')->where('mpe_status', '=', '1')
        ->whereRaw('"'.Carbon::now().'" between `mpe_startdate` and `mpe_enddate`')->first();
        // dd($periode);
        $incubations = MasterProgramInkubasi::all();
        $categories = MasterCategory::all();
        $societies = MasterCivitas::all();
        $universities = MasterUniversitas::all();
        $faculties = MasterFakultas::all();
        $studyPrograms = MasterProgramStudy::all();
        $history = null;
        // $questions = MasterQuestion::all();
        // $questionRange=MasterQuestionRange::all();
        $components = MasterComponent::with('periodeProgram.masterPeriode.masterPeriodeProgram', 'periodeProgram.masterProgramInkubasi','question', 'question.questionRange')->where('mct_step',1)->get();
        return view('Startup.daftarStartup', compact(
            'incubations',
            'categories',
            'societies',
            'universities',
            'faculties',
            'studyPrograms',
            'components',
            'history',
            'periode'));

        // dd($components);
    }

    public function store(Request $request){
        // dd($request);
        if($request->collect('universitas-input')){
            // lainya create univ, fakultas, prodi
            // create universitas
            $univ = $request->universitas;
            $count = 0;
            for($i=0; $i<count($univ); $i++){
                if($univ[$i]=='lainnya'){
                    $duplicateUniv = MasterUniversitas::where('mu_name', $request->collect('universitas-input')[$count])->first();
                    if($duplicateUniv == null){   
                        $createUniv = MasterUniversitas::create([
                            'mu_name' => $request->collect('universitas-input')[$count],
                            'mu_description' => '-',
                        ]);
                        $univ[$i] = $createUniv->mu_id;
                        $count+=1;
                    }else{
                        $univ[$i] = $duplicateUniv->mu_id;
                        $count+=1;
                    }
                }
            }
        }
        
        // create fakultas
        if($request->collect('fakultas-input')){
            $fakultas = $request->fakultas;
            $count=0;
            for($i=0; $i<count($fakultas); $i++){
                if($fakultas[$i]=='lainnya'){
                    $duplicateFakultas = MasterFakultas::where('mf_name', $request->collect('fakultas-input')[$count])->first();
                    if($duplicateFakultas == null){
                    $createFakultas = MasterFakultas::create([
                        'mf_name' => $request->collect('fakultas-input')[$count],
                        'mf_description' => '-',
                        'mu_id' => (int)$univ[$i],
                    ]);
                    $fakultas[$i] = $createFakultas->mf_id;
                    $count+=1;
                }else{
                    $fakultas[$i] = $duplicateFakultas->mf_id;
                    $count+=1;
                }
            }
        }
    }
            
        if($request->collect('prodi-input')){
            //create prodi
            $prodi = $request->prodi;
            $count=0;
            for($i=0; $i<count($prodi); $i++){
                if($prodi[$i]=='lainnya'){
                    $duplicateProdi = MasterProgramStudy::where('mps_name', $request->collect('prodi-input')[$count])->first();
                    if($duplicateProdi == null){
                    $createProdi = MasterProgramStudy::create([
                        'mps_name' => $request->collect('prodi-input')[$count],
                        'mps_description' => '-',
                        'mf_id' => (int)$fakultas[$i],
                    ]);
                    $prodi[$i] = $createProdi->id;
                    $count+=1;
                }else{
                    $prodi[$i] = $duplicateProdi->id;
                    $count+=1; 
                }
            }
        }
    }
    
    // dd($prodi);
        
        // $mpdId = MasterPeriodeProgram::with('component')->where('mpd_id', $request->programStartup)->first()->mpd_id;
        // dd($mpdId);
        $pitchDeck = $request->file('pitchDeck');
        $pitchDeckPath = $pitchDeck->store('pitch_deck', 'public');
        
        $startup = MasterStartup::create([
            'ms_startdate'=> Carbon::now(),
            'ms_pks' => $request->programStartup,
            'ms_phone' => $request->kontakStartup,
            'mc_id' => $request->kategori,
            'ms_name' => $request->namaStartup,
            'ms_address' => $request->alamat,
            'ms_website' => $request->website,
            'ms_socialmedia' => $request->sosialMedia,      
            'ms_legal' => $request->legalitas,
            'ms_pitchdeck' => $pitchDeckPath,
            'ms_email'=>$request->emailStartup,
            'user_id'=>$request->userid,
            'ms_yearly_income' => $request->pendapatanTahunan,
            'ms_year_founded' => $request->tahunDidirikan,
            'ms_focus_area' => $request->areaFokusBisnis,
            'ms_funding_sources' => $request->sumberPendanaan,
            'mpd_id'=> $request->programStartup,
            'ms_status'=>"1",
        ]);
        
        // dd($request);
            // dd($startup->ms_id);
            $msid = $startup->ms_id;
            
        $cvInput = [];
        for($i =0; $i < count($request->file('cv')); $i++){
            $cv = $request->file('cv')[$i];
            $cvPath = $cv->store('cv', 'public');
            array_push($cvInput, $cvPath);
        }

        for($i=0; $i< count($request->namaLengkap); $i++){
            // dd($prodi[$i]);
            MasterMember::create([
                'mm_name' => $request->namaLengkap[$i],
                'mm_nik' => $request->nik[$i],
                'mm_position' => $request->jabatan[$i],
                'mm_phone' => $request->nomorHp[$i],
                'mm_email' => $request->email[$i],
                'mm_nim_nip' => $request->nimNip[$i],
                'mm_socialmedia' => $request->mediaSosial[$i],
                'mu_id' => $univ[$i],
                'mf_id' => $fakultas[$i],
                'mps_id' => $prodi[$i],
                'mci_id' => $request->civitasTelu[$i],
                'mm_cv' => $cvInput[$i],
                'ms_id' => $msid,
            ]);
        }

        // count final score
        $score = 0;
        for($i =0; $i < count($request->answers); $i++){
            $point = MasterQuestionRange::where('mqr_id', $request->answers[$i])->get();
            $subset = $point->map(function($point){
                return collect($point->toArray())->only(['mqr_poin'])->all();
            });
            $score += (int)$subset[0]["mqr_poin"];
        }
        $finalScore = (int)$score / (int)count($request->answers);
        
        $scs = StartupComponentStatus::create([
            'scs_notes' => $request->catatan,
            'ms_id' => $msid,
            'scs_totalscore' => $finalScore,
        ]);

        
        $question = MasterPeriodeProgram::with('component.question.questionRange')->where('mpd_id', $request->mpdid)->first();
        // dd($request);
        for($i =0; $i < count($request->answers); $i++){
            // dd(StartupComponentStatus::where('ms_id', $msid)->first()->scs_id);
            // dd($question);
            RegistationAnswer::create([
                'mq_id' => $question->component[0]->question[$i]->id,
                'mqr_id' => (int)$request->answers[$i],
                'user_id' => (int)$request->userid,
                'ra_score' => MasterQuestionRange::where('mqr_id', $request->answers[$i])->first()->mqr_poin,
                'scs_id' => $scs->scs_id,
            ]);
        }
        

        RegistationStatus::create([
            'ms_id' => $msid,
            'srt_step' => 2,
        ]);

        HistoryStartup::create([
            'ms_id' => $msid,
            'mpd_id' => $request->programStartup,
            'user_id' => $request->userid,
        ]);

        return redirect()->route('dashboard');
    }


    public function setInkubasi(Request $request){
        $component = MasterComponent::with('question', 'question.questionRange', 'periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')
        ->where('mpd_id', $request->program_id)->where('mct_step', 1)->first();
        return response()->json($component);
    }
}
