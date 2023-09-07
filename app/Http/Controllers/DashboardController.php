<?php

namespace App\Http\Controllers;

use App\Models\MasterStartup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index($userId){
        $periode = DB::table('master_periode')->where('mpe_status', '=', '1')->get();
        $status=0;
        if($periode->isNotEmpty()){
            $status = Carbon::now()->between($periode[0]->mpe_startdate,$periode[0]->mpe_enddate);
        }
        $startup = MasterStartup::where('user_id', $userId)->get()->first();
        // dd(MasterStartup::where('user_id', $userId)->get()->first());

        return view('dashboard')->with(compact('periode','status', 'startup'));
    }
}
