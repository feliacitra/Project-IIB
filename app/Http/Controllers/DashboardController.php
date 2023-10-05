<?php

namespace App\Http\Controllers;

use App\Models\HistoryStartup;
use App\Models\MasterPeriode as ModelsMasterPeriode;
use App\Models\MasterStartup;
use App\Models\MasterPeriode;
use App\Models\MasterPeriodeProgram;
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
        if(auth()->user()->role != 1){

            $penilaianDate = '';
                $startDate = '';
                $periode='';
                $history = null;
                $startup=null;
                
            if(request('history')){
                $periode = MasterPeriode::with('masterPeriodeProgram')
                ->whereHas('masterPeriodeProgram', function($q){
                    $q->where('mpd_id', request('history'));
                })->first();
            }
            // dd(request());
            if(request('history') != null && $periode->mpe_status==0){
                
                // dd($periode);
                $status = Carbon::now()->between($periode->mpe_startdate, $periode->mpe_enddate);

                $startup = MasterStartup::with('startupComponentStatus',
                'masterPeriodeProgram',
                'masterPeriodeProgram.masterPeriode',
                'registationStatus',
                'startupComponentStatus.registationAnswer')->where('mpd_id', request('history'))
                ->first();

                $history = MasterStartup::with('historyStartup.masterPeriodeProgram.masterPeriode')->where('user_id', auth()->id())->first();
                // dd($periode);
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
                    if($startup != null){
                        $penilaianDate = date('d-M-Y', strtotime($startup->registationStatus->updated_at));
                        $startDate = date('d-M-Y', strtotime($startup->ms_startdate));
                    }      
                    $check = 0;
                }
                return view('dashboard')->with(compact('periode','status', 'startup', 'penilaianDate', 'startDate', 'history', 'check'));
            }
        return view('dashboard');
    }
}
