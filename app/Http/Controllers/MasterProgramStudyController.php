<?php

namespace App\Http\Controllers;

use App\Models\MasterFakultas;
use App\Models\MasterProgramStudy;
use Illuminate\Http\Request;
use App\Models\MasterUniversitas;

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

        $programStudi = MasterProgramStudy::latest('updated_at')->with('faculty.university');

        if (request('search')){
            $programStudi->where('mps_name', 'like', '%'.request('search').'%')
                ->orWhere('mps_description', 'like', '%'.request('search').'%');
        }

        return view('Master-ProgramStudi.listProdi', [
            "keyword" => request('search'),
            "programStudi" => $programStudi->get(),
            "universities" => $universities,
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
            'addUniversity' => 'required',
            'addFaculty' => 'required|exists:master_fakultas,mf_id',
            'addNamaProdi' => 'required|max:255|unique:master_programstudy,mps_name',
            'addKeteranganProdi' => 'nullable',
        ], [
            'addFaculty.required' => 'Fakultas tidak boleh kosong',
            'addNamaProdi.required' => 'Nama program studi tidak boleh kosong',
            'addNamaProdi.unique' => 'Nama program studi sudah digunakan',
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
    public function update(Request $request, MasterProgramStudy $masterProgramStudy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterProgramStudy  $masterProgramStudy
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterProgramStudy $masterProgramStudy)
    {
        //
    }

    public function getFaculties(int $universityId)
    {
        $faculties = MasterFakultas::where('mu_id', $universityId)->get();
        return response()->json($faculties);
    }
}
