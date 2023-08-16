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
    public function index(Request $request)
    {
        $builder = MasterComponent::query();
        if ($request->has('pilihPeriode') && $request->pilihPeriode != 'select') {
            $pilihPeriode = request('pilihPeriode');
            $builder->orWhereHas('periodeProgram.masterPeriode', function ($query) use ($pilihPeriode) {
                $query->where('mpe_id', 'like', '%' . $pilihPeriode . '%');
            });
        }

        if ($request->has('pilihProgram') && $request->pilihProgram != 'select') {
            $pilihProgram = request('pilihProgram');
            $builder->orWhereHas('periodeProgram.masterPeriode.masterProgramInkubasi', function ($query) use ($pilihProgram) {
                $query->where('mpi_id', 'like', '%' . $pilihProgram . '%');
            });
        }

        if ($request->has('pilihSeleksi') && $request->pilihSeleksi != 'select') {
            dd(request('search'));
            $pilihSeleksi = request('pilihSeleksi');
            $builder->orWhere('mct_step', 'like', '%' . $pilihSeleksi . '%');
        }

        if (request('search')){
            $step = -1;
            $status = 0;
            if (request('search') == 'Self Assessment') {
                $step = 1;
            } else if (request('search') == 'Presentasi') {
                $step = 2;
            } else {
                $step = 3;
            }

            if (request('search') == 'AKTIF') {
                $status = 1;
            } else {
                $status = 0;
            }

            // $components = MasterComponent::with('periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')
            // ->where(function ($query) {
            //     $query->orWhereHas('periodeProgram', function ($subquery) {
            //         $subquery->orWhereHas('masterPeriode', function ($nestedSubquery) {
            //             $nestedSubquery->where('mpe_name', 'like', '%'.request('search').'%')
            //             ->orWhere('mpe_status', 'like', '%'.request('search').'%');
            //         })->orWhereHas('masterProgramInkubasi', function ($nestedSubquery) {
            //             $nestedSubquery->where('mpi_name', 'like', '%'.request('search').'%')
            //             ->orWhere('mpi_description', 'like', '%'.request('search').'%');
            //         });
            //     });
            // })->get();
            $search = request('search');
            $builder->orWhere('mct_step', 'like', '%' . $search . '%')
                ->orWhereHas('periodeProgram.masterPeriode.masterProgramInkubasi', function ($query) use ($search) {
                    $query->where('mpi_name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('periodeProgram.masterPeriode', function ($query) use ($search) {
                    $query->where('mpe_name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('question', function ($query) use ($search) {
                    $query->where('mq_question', 'like', '%' . $search . '%');
                });
        }
        $components = $builder->get();
        $periode = MasterPeriode::all();
        $programInkubasi = MasterProgramInkubasi::all();

        return view('Master-KomponenPenilaian.listKomponenPenilaian', compact('components', 'periode', 'programInkubasi'));
    }

    public function create($id)
    {
        $component = MasterComponent::with('question', 'question.questionRange', 'periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')->where('mct_id', $id)->first();
        // $periode = MasterPeriode::with('masterPeriodeProgram.component.question')->whereHas('masterPeriodeProgram', function ($query) use ($component) {
        //     $query->whereHas('component', function ($subquery) use ($component) {
        //         $subquery->whereHas('periodeProgram.masterProgramInkubasi', function ($nestedSubquery) use ($component) {
        //             $nestedSubquery->where('mpi_id', $component->periodeProgram->masterProgramInkubasi->mpi_id);
        //             })
        //             ->where('mct_step', $component->mct_step)
        //             ->where('mct_id', '!=', $component->mct_id);
        //     });
        // })->get();
        // $periode = MasterPeriode::with('masterPeriodeProgram.component.question')
        //     ->whereHas('masterPeriodeProgram', function ($query) use ($component) {
        //         $query->whereHas('component', function ($subquery) use ($component) {
        //             $subquery->whereHas('periodeProgram', function ($nestedSubquery) use ($component) {
        //                 $nestedSubquery->whereHas('masterPeriode', function ($innerNestedSubquery) use ($component) {
        //                     $innerNestedSubquery->where('mpe_id')
        //                 })
        //             })
        //         })
        //     })
        // $periode = MasterPeriode::with('masterPeriodeProgram.component.question')
        //     ->where('mpe_id', '!=', $component->periodeProgram->masterPeriode->mpe_id)
        //     ->whereHas('masterPeriodeProgram.masterProgramInkubasi', function ($query) use ($component) {
        //         $query->where('mpi_id', $component->periodeProgram->masterProgramInkubasi->mpi_id);
        //     })
        //     ->whereHas('masterPeriodeProgram.component', function ($query) use ($component) {
        //         $query->where('mct_step', $component->mct_step);
        //     })
        //     ->get();
        $periode = MasterComponent::with('periodeProgram.masterPeriode', 'question')
            ->where('mct_step', $component->mct_step)
            ->whereHas('periodeProgram.masterPeriode', function ($query) use ($component) {
                $query->where('mpe_id', '!=', $component->periodeProgram->masterPeriode->mpe_id);
            })
            ->get();
        // dd($periode);
        return view('Master-KomponenPenilaian.kelolaKomponenEdit', compact('component', 'periode', 'id'));
    }

    public function show($id)
    {
        $component = MasterComponent::with('question', 'question.questionRange', 'periodeProgram.masterPeriode', 'periodeProgram.masterProgramInkubasi')->where('mct_id', $id)->first();
        // dd($component->question);
        // $question = MasterQuestion::with('questionRange')->where('mct_id', $id)->get();
        // $questionRange = MasterQuestionRange::where('mq_id', $component->question->mq_id)->get();
        return view('Master-KomponenPenilaian.kelolaKomponenView', compact('component'));
    }

    public function storeQuest(Request $request, $id)
    {
        $komponen = MasterComponent::find($id);
        if ($komponen != null) {
            $questions = MasterQuestion::where('mct_id', $id)->get();
            foreach ($questions as $question) {
                $answers = MasterQuestionRange::where('mq_id', $question->id)->get();
                foreach ($answers as $answer) {
                    $answer->delete();
                }
                $question->delete();
            }
        }
        
        if (!$request->filled('pertanyaan')) {
            return redirect()->route('master.penilaian');
        }

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
        
        // dd($num);
        
        foreach ($pertanyaan as $quest) {
            $question = MasterQuestion::firstOrCreate(['mq_question' => $quest, 'mct_id' => $id]);
            // $question->component()->associate($component);
            // $question->save();
            $questions[] = $question;
        }
        
        $start = 0;
        for ($i=0; $i < count($num); $i++) { 
            for ($j=$start; $j < $num[$i]+$start; $j++) { 
                $questionRange = MasterQuestionRange::firstOrCreate([
                    'mqr_description' => $jawaban[$j],
                    'mqr_poin' => $nilai[$j],
                    'mq_id' => $questions[$i]->id
                ]);
                $questionRange->question()->associate($questions[$i]);
                $questionRange->save();
            }
            $start = $num[$i];
        }

        return redirect()->route('master.penilaian')->with('success', "Berhasil mengubah pertanyaan pada komponen");
    }

    public function copyQuest(Request $request, $id) {
        $component = MasterComponent::with('question', 'question.questionRange', 'periodeProgram', 'periodeProgram.masterProgramInkubasi')->where('mct_id', $id)->first();
        $periode = $request->periode;
        
        $target = MasterComponent::with('question', 'question.questionRange')
        ->where('mct_step', $component->mct_step)
        ->where('mct_id', '!=', $component->mct_id)
        ->get();
        // dd($target);
        
        // foreach ($target->question as $question) {
            // $targetQuestion = MasterQuestion::firstOrCreate(['mq_question' => $question->mq_question, 'mct_id' => $component->mct_id]);
            // foreach ($question->questionRange as $qr) {
            //     MasterQuestionRange::firstOrCreate([
            //         'mqr_description' => $qr->mqr_description,
            //         'mqr_poin' => $qr->mqr_poin,
            //         'mq_id' => $targetQuestion->id
            //     ]);
            // }
        // }
        // dd($component->mct_id);
        

        foreach ($target as $tc) {
            if (count($tc->question) == 0) {
                continue;
            }
            foreach ($tc->question as $question) {
                // dd($tc->mct_id);

                $targetQuestion = MasterQuestion::firstOrCreate(['mq_question' => $question->mq_question, 'mct_id' => $component->mct_id]);
                foreach ($question->questionRange as $qr) {
                    MasterQuestionRange::firstOrCreate([
                        'mqr_description' => $qr->mqr_description,
                        'mqr_poin' => $qr->mqr_poin,
                        'mq_id' => $targetQuestion->id
                    ]);
                }
            }
        }
        return redirect()->route('penilaian.create', $id);
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

        return redirect()->route('master.penilaian')->with('success', "Berhasil menambahkan komponen penilaian");

    }

    public function destroy($id)
    {
        $komponen = MasterComponent::find($id);
        $questions = MasterQuestion::where('mct_id', $id)->get();
        foreach ($questions as $question) {
            $answers = MasterQuestionRange::where('mq_id', $question->id)->get();
            foreach ($answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        }
        $komponen->delete();
        return redirect()->route('master.penilaian');
    }
}
