<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPeriode;
use App\Models\MasterProgramInkubasi;
use App\Models\MasterComponent;
use App\Models\MasterPeriodeProgram;

class MasterKomponenPenilaianController extends Controller
{
    public function index()
    {
        $components = MasterComponent::all();
        $periode = MasterPeriode::all();
        $programInkubasi = MasterProgramInkubasi::all();

        // if (request('search')) {
        //     $searchTerm = request('search');

        //     $components = $components->filter(function ($component) use ($searchTerm) {
        //         return stripos($component->mf_name, $searchTerm) !== false
        //             || stripos($component->mf_description, $searchTerm) !== false;
        //     });
        // }

        return view('Master-KomponenPenilaian.listKomponenPenilaian', compact('components', 'periode', 'programInkubasi'));
    }

    public function store(Request $request)
    {
        $mpe_id = $request->input('pilihNamaPeriode');
        $mpi_id = $request->input('pilihProgramInkubasi');
        $tahap = $request->input('pilihTahapanSeleksi');

        $periode = MasterPeriode::find($mpe_id);
        $programInkubasi = MasterProgramInkubasi::find($mpi_id);

        $periode->masterProgramInkubasi()->save($programInkubasi);

        MasterComponent::create([
            'mct_step' => $tahap
        ]);

        return redirect()->route('master.penilaian');

    }
}
