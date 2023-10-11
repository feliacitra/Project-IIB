<?php

namespace App\Http\Controllers;

use App\Models\HistoryStartup;
use App\Models\MasterPeriode as ModelsMasterPeriode;
use App\Models\MasterStartup;
use App\Models\MasterPeriode;
use App\Models\MasterPeriodeProgram;
use App\Models\PresentationSchedule;
use App\Models\User;
use App\Notifications\PendaftaranStartupNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Support\Facades\Auth;
use MasterPeriode as GlobalMasterPeriode;

class DashboardController extends Controller
{

    
    public function index(){
        // dd(request());
        if(auth()->user()->role != 1){

            $penilaianDate = '';
                $startDate = '';
                $periode='';
                $presentasiDate= '';
                $history = null;
                $startup=null;
                
            if(request('history')){
                $periode = MasterPeriode::with('masterPeriodeProgram')
                ->whereHas('masterPeriodeProgram', function($q){
                    $q->where('mpd_id', request('history'));
                })->first();
            }
            // dd(request());
            // if(request('history') != null && $periode->mpe_status==0){
            if(request('history') != null){
                
                // dd($periode);
                $status = Carbon::now()->between($periode->mpe_startdate, $periode->mpe_enddate);

                $startup = MasterStartup::with('startupComponentStatus',
                'masterPeriodeProgram',
                'masterPeriodeProgram.masterPeriode',
                'registationStatus',
                'startupComponentStatus.registationAnswer')->where('mpd_id', request('history'))
                ->where('user_id', auth()->user()->id)->first();

                $history = MasterStartup::with('historyStartup.masterPeriodeProgram.masterPeriode')->where('user_id', auth()->id())->first();
                // dd($startup);
                $check = 1;
            }else{
                if(MasterPeriode::first()){
                    
                    $dt = Carbon::now();
                    $periode = MasterPeriode::with('masterPeriodeProgram')->where('mpe_status', '=', '1')
                    ->whereRaw('"'.$dt.'" between `mpe_startdate` and `mpe_enddate`')->first();
                    // dd($periode);
                    $status=0;

                    $UserStartup = MasterStartup::with('startupComponentStatus',
                    'masterPeriodeProgram',
                    'masterPeriodeProgram.masterPeriode',
                    'registationStatus',
                    'startupComponentStatus.registationAnswer')->where('user_id', auth()->id())
                    ->get();
                    
                    if($periode != null){
                        $status = Carbon::now()->between($periode->mpe_startdate, $periode->mpe_enddate);
                        for($i = 0; $i < count($UserStartup); $i++){
                            if($UserStartup[$i]->masterPeriodeProgram->masterPeriode->mpe_id == $periode->mpe_id){
                                $startup = $UserStartup[$i];
                                break;
                            }
                        }
                    }
                    
                    
                    if(MasterStartup::with('historyStartup')->where('user_id', auth()->id())->first() != null){
                        $history = MasterStartup::with('historyStartup.masterPeriodeProgram.masterPeriode')->where('user_id', auth()->id())->first();
                    }
                    
                }
                // $startup = $UserStartup;
                $check = 0;
                }

                // dd($startup);
                if($startup != null){
                    $penilaianDate = date('d-M-Y', strtotime($startup->registationStatus[0]->updated_at));
                    $startDate = date('d-M-Y', strtotime($startup->ms_startdate));
                    // dd($penilaianDate);
                    }      
                $presentasi = PresentationSchedule::with('MasterPeriodeProgram.MasterPeriode', 'MasterStartup', 'presentationEvaluator')
                ->whereHas('MasterStartup', function($q){
                    $q->where('user_id', auth()->user()->id);
                })->first();
                if(isset($presentasi->presentationEvaluator)){
                    $presentasiDate = $presentasi->presentationEvaluator->created_at;
                }
                $tampilSidebar = 0;
                $periodeAktif = 0;
                // dd(isset($startup->registationStatus[1]));
                if(isset($startup->registationStatus[1]) && $startup->registationStatus[1]->srt_status == 'Lulus'){
                    $tampilSidebar = 1;
                    if($startup->masterPeriodeProgram->masterPeriode->mpe_status==1){
                        $periodeAktif = 1;
                    }
                }
                // dd($startup->registationStatus[1]->srt_status);
                
                // dd($periodeAktif);
                // jadwal presentasi


                return view('dashboard')->with(compact('periode','status', 'startup', 'penilaianDate', 'startDate', 'history', 'check', 'presentasiDate', 'tampilSidebar', 'presentasi', 'periodeAktif'));
            }
        return view('dashboard');
    }
}
