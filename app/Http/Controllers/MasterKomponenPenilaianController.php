<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPeriode;
use App\Models\MasterProgramInkubasi;
use App\Models\MasterComponent;
use App\Models\MasterQuestion;
use App\Models\MasterQuestionRange;
use App\Models\MasterPeriodeProgram;

class MasterKomponenPenilaianController extends Controller
{
    public function index()
    {
        $components = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')->get();
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

    public function create($id)
    {
        $component = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')->where('mct_id', $id)->get();
        return view('Master-KomponenPenilaian.kelolaKomponenEdit', compact('component', 'id'));
    }

    public function storeQuest(Request $request, $id)
    {
        $pertanyaan = $request->pertanyaan;
        $jawaban = $request->jawaban;
        $num = $request->num;
        $nilai = $request->nilai;

        $questions = array();

        $data = [
            'pertanyaan' => $pertanyaan,
            'jawaban' => $jawaban,
            'num' => $num,
            'nilai' => $nilai
        ];

        $component = MasterComponent::find($id);

        foreach ($pertanyaan as $quest) {
            $question = MasterQuestion::create(['mq_question' => $quest, 'mct_id' => $id]);
            // $question->component()->associate($component);
            // $question->save();
            $questions[] = $question;
        }
        
        $start = 0;
        for ($i=0; $i < count($num); $i++) { 
            for ($j=$start; $j < $num[$i]; $j++) { 
                $questionRange = MasterQuestionRange::create([
                    'mqr_description' => $jawaban[$j],
                    'mqr_poin' => $nilai[$j],
                    'mq_id' => $questions[$i]->mq_id
                ]);
                $questionRange->question()->associate($questions[$i]);
                $questionRange->save();
            }
            $start = $num[$i];
        }

        return redirect()->route('master.penilaian');
    }

    public function store(Request $request)
    {
        $mpe_id = $request->input('pilihNamaPeriode');
        $mpi_id = $request->input('pilihProgramInkubasi');
        $tahap = $request->input('pilihTahapanSeleksi');

        $periode = MasterPeriode::find($mpe_id);
        $programInkubasi = MasterProgramInkubasi::find($mpi_id);
        
        if (!$programInkubasi->masterPeriode->contains($mpe_id)) {
            $programInkubasi->masterPeriode()->attach($mpe_id);
        }
        
        $periodeProgram = MasterPeriodeProgram::where('mpe_id', $mpe_id)->where('mpi_id', $mpi_id)->first();
        
        $component = new MasterComponent;
        
        $component->mct_step = $tahap;
        $component->mpd_id = $periodeProgram->mpd_id;

        $component->save();

        return redirect()->route('master.penilaian');

    }
}
