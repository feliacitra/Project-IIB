<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPeriode;
use App\Models\MasterProgramInkubasi;
use App\Models\MasterComponent;

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
}
