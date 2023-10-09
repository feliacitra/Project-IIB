<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterPeriode;
use App\Models\MasterStartup;
use App\Models\PresentationSchedule;
use App\Models\User;

class PresentationSecheduleController extends Controller
{
    public function index()
    {
        $periode = MasterPeriode::all();
        $startup = MasterStartup::all();
        $user = User::where('role', '3')->get();

        $presentasi = PresentationSchedule::with('MasterPeriodeProgram.MasterPeriode', 'MasterStartup')->get();

        return view('Pendaftaran-KelolaJadwalPresentasi.listJadwalPresentasi', compact('periode', 'startup', 'user', 'presentasi'));
    }

    public function store(Request $request)
    {
        $periode = $request->input('periode');
        $startup = $request->input('startup');
        $penilai = $request->input('penilai');
        $tanggal = $request->input('tanggal');

        $time_from = $request->input('time_from');
        $time_to = $request->input('time_to');

        $convertedFrom = date("H:i:s", strtotime($time_from));
        $convertedTo = date("H:i:s", strtotime($time_to));

        $online = $request->input('online');
        $tempat = $request->input('tempat');
        $link = $request->input('link');

        $startup_record = MasterStartup::find($startup);

        PresentationSchedule::create([
            'ps_date' => $tanggal,
            'ps_timestart' => $convertedFrom,
            'ps_timeend' => $convertedTo,
            'ps_online' => $online,
            'ps_place' => $tempat,
            'ps_link' => $link,
            'mpd_id' => $startup_record->mpd_id,
            'ms_id' => $startup
        ]);

        return redirect()->route('jadwalpresentasi')->with('success', 'Data berhasil ditambah');

    }

    public function delete(int $id)
    {
        PresentationSchedule::where('ps_id', $id)->delete();
        return redirect()->route('jadwalpresentasi')->with('success', 'Data berhasil dihapus');
    }
}
