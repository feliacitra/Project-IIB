<?php

namespace App\Http\Controllers;

use App\Models\HistoryStartup;
use App\Models\MasterPeriode as ModelsMasterPeriode;
use App\Models\MasterStartup;
use App\Models\MasterPeriode;
use App\Models\User;
use App\Notifications\PendaftaranStartupNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    
    public function index(){
       
        if(auth()->user()->role != 1){

            if(MasterPeriode::first()){

                $penilaianDate = '';
                $startDate = '';
                $periode='';
                $history = null;

                $periode = DB::table('master_periode')->where('mpe_status', '=', '1')->first();
                // dd($periode);
                $status=0;
                if($periode != null){
                    $status = Carbon::now()->between($periode->mpe_startdate, $periode->mpe_enddate);
                }
                
                $startup = MasterStartup::with('startupComponentStatus',
                'masterPeriodeProgram',
                'masterPeriodeProgram.masterPeriode',
                'registationStatus',
                'startupComponentStatus.registationAnswer')->where('user_id', auth()->id())->first();
                
                if(MasterStartup::with('historyStartup')->where('user_id', auth()->id())->first() != null){
                    $history = MasterStartup::with('historyStartup')->where('user_id', auth()->id())->first();
                }
                
                if($startup != null){
                    $penilaianDate = date('d-M-Y', strtotime($startup->registationStatus->updated_at));
                    $startDate = date('d-M-Y', strtotime($startup->ms_startdate));
                }      
                return view('dashboard')->with(compact('periode','status', 'startup', 'penilaianDate', 'startDate', 'history'));
            }
        }
        return view('dashboard');
    }
}
