<?php

namespace App\Http\Controllers;

use App\Models\MasterCivitas;
use Illuminate\Http\Request;

class MasterCivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Master-Civitas.listCivitas', [
            "civitas" => MasterCivitas::latest('updated_at')->get(),
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
            'addNamaCivitas' => 'required|max:255|unique:master_civitas,mci_name',
            'addKeteranganCivitas' => 'nullable'
        ], [
            'addNamaCivitas.required' => 'Nama civitas tidak boleh kosong',
            'addNamaCivitas.unique' => 'Nama civitas sudah digunakan',
        ]);

        MasterCivitas::create([
            'mci_name' => $validatedData['addNamaCivitas'],
            'mci_description' => $validatedData['addKeteranganCivitas'],
        ]);

        return redirect()->route('master.civitas')->with('success', 'Civitas berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterCivitas  $masterCivitas
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCivitas $masterCivitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterCivitas  $masterCivitas
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCivitas $masterCivitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterCivitas  $masterCivitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $mci = MasterCivitas::where('mci_id', $id)->firstOrFail();
        
        $rules = [
            'editNamaCivitas' => 'required',
            'editKeteranganCivitas' => 'nullable',
        ];

        if ($request->input('editNamaCivitas') != $mci->mci_name) {
            $rules['editNamaCivitas'] = 'required|unique:master_civitas,mci_name';
        }

        $validatedData = $request->validate($rules, [
            'editNamaCivitas.required' => 'Nama civitas tidak boleh kosong',
            'editNamaCivitas.unique' => 'Nama civitas sudah digunakan',
        ]);

        MasterCivitas::where('mci_id', $id)->update([
            'mci_name' => $validatedData['editNamaCivitas'],
            'mci_description' => $validatedData['editKeteranganCivitas'],
        ]);

        return redirect()->route('master.civitas')->with('success', 'Civitas berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterCivitas  $masterCivitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterCivitas $masterCivitas)
    {
        //
    }
}
