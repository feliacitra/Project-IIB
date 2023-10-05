<?php

namespace App\Http\Controllers;

use App\Models\MasterFakultas;
use App\Models\MasterProgramStudy;
use Illuminate\Http\Request;
use App\Models\MasterUniversitas;
use Illuminate\Validation\Rule;

class MasterProgramStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = MasterUniversitas::all();
        $faculties = MasterFakultas::all();
        $programStudi = MasterProgramStudy::latest('updated_at')->with('faculty.university');

        if (request('search')){
            $programStudi->where('mps_name', 'like', '%'.request('search').'%')
                ->orWhere('mps_description', 'like', '%'.request('search').'%');
        }

        return view('Master-ProgramStudi.listProdi', [
            "keyword" => request('search'),
            "programStudi" => $programStudi->get(),
            "universities" => $universities,
            "faculties" => $faculties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'addNamaProdi' => [
                'required',
                Rule::unique('master_programstudy', 'mps_name')->where(function ($query) use ($request) {
                    return $query->where('mf_id', $request->input('addFaculty'));
                }),
            ],
            'addKeteranganProdi' => 'nullable',
            'addUniversity' => 'required',
            'addFaculty' => [
                'required',
                'exists:master_fakultas,mf_id',
                Rule::unique('master_programstudy', 'mf_id')->where(function ($query) use ($request) {
                    return $query->where('mps_name', $request->input('editNamaProdi'));
                }),
            ],
        ], [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah digunakan',
        ], [
            'addUniversity' => 'Nama universitas',
            'addFaculty' => 'Nama fakultas',
            'addNamaProdi' => 'Nama program studi',
            'addKeteranganProdi' => 'Keterangan program studi',
        ]);

        MasterProgramStudy::create([
            'mps_name' => $validatedData['addNamaProdi'],
            'mps_description' => $validatedData['addKeteranganProdi'],
            'mf_id' => $validatedData['addFaculty'],
        ]);

        $nama = $request->input('addNamaProdi');

        return redirect()->route('master.prodi')->with('success', "Program studi $nama berhasil ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterProgramStudy  $masterProgramStudy
     * @return \Illuminate\Http\Response
     */
    public function show(MasterProgramStudy $masterProgramStudy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterProgramStudy  $masterProgramStudy
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterProgramStudy $masterProgramStudy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterProgramStudy  $masterProgramStudy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $prodi = MasterProgramStudy::where('mps_id', $id)->firstOrFail();

        $rules = [
            'editUniversitas' => 'required',
            'editFakultas' => 'required|exists:master_fakultas,mf_id',
            'editNamaProdi' => 'required|max:255',
            'editKeteranganProdi' => 'required|max:255',
        ];

        if ($request->editNamaProdi != $prodi->mps_name)
        {
            $rules['editNamaProdi'] = [
                'required',
                Rule::unique('master_programstudy', 'mps_name')->where(function ($query) use ($request) {
                    return $query->where('mf_id', $request->input('editFakultas'));
                }),
            ];
        }

        if ($request->editFakultas != $prodi->mf_id)
        {
            $rules['editFakultas'] = [
                'required',
                'exists:master_fakultas,mf_id',
                Rule::unique('master_programstudy', 'mf_id')->where(function ($query) use ($request) {
                    return $query->where('mps_name', $request->input('editNamaProdi'));
                }),
            ];
        };

        $validatedData = $request->validate($rules, [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah digunakan',
        ], [
            'editUniversitas' => 'Nama universitas',
            'editFakultas' => 'Nama fakultas',
            'editNamaProdi' => 'Nama program studi',
            'editKeteranganProdi' => 'Keterangan program studi',
        ]);

        MasterProgramStudy::where('mps_id', $id)->update([
            'mps_name' => $validatedData['editNamaProdi'],
            'mps_description' => $validatedData['editKeteranganProdi'],
            'mf_id' => $validatedData['editFakultas']
        ]);

        $name = $request->input('editNamaProdi');

        return redirect()->route('master.prodi')->with('success', "Program studi $name berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterProgramStudy  $masterProgramStudy
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $prodi = MasterProgramStudy::where('mps_id', $id)->firstOrFail();
        $name =$prodi->mps_name;

        MasterProgramStudy::where('mps_id', $id)->delete();
        return redirect()->route('master.prodi')->with('success', "Prodi $name berhasil dihapus");
    }

    public function getFaculties(int $universityId)
    {
        $faculties = MasterFakultas::where('mu_id', $universityId)->get();
        return response()->json($faculties);
    }

    public function getProdi(int $fakultasId){
        $prodi = MasterProgramStudy::where('mf_id', $fakultasId)->get();
        // dd($prodi);
        return response()->json($prodi);
    }
}
