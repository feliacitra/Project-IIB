<?php

namespace App\Http\Controllers;

use App\Models\MasterCivitas;
use App\Models\MasterMember;
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
        $civitas = MasterCivitas::latest('updated_at');

        if (request('search')){
            $civitas->where('mci_name', 'like', '%'.request('search').'%')
                ->orWhere('mci_description', 'like', '%'.request('search').'%');
        }

        return view('Master-Civitas.listCivitas', [
            "civitas" => $civitas->get(),
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

        $nama = $request->input('addNamaCivitas');

        return redirect()->route('master.civitas')->with('success', "Civitas $nama berhasil ditambah");
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
        $mci_name = $mci->mci_name;
        $mci_name_request = $request->input('editNamaCivitas');

        $rules = [
            'editNamaCivitas' => 'required',
            'editKeteranganCivitas' => 'nullable',
        ];

        if ($request->input('editNamaCivitas') !== $mci->mci_name_request) {
            $rules['editNamaCivitas'] = 'required|unique:master_civitas,mci_name';
        }

        $validatedData = $request->validate($rules, [
            'editNamaCivitas.required' => "Gagal memperbarui civitas $mci_name, Nama civitas tidak boleh kosong",
            'editNamaCivitas.unique' => "Gagal memperbarui civitas $mci_name, Nama civitas $mci_name_request sudah digunakan",
        ]);

        MasterCivitas::where('mci_id', $id)->update([
            'mci_name' => $validatedData['editNamaCivitas'],
            'mci_description' => $validatedData['editKeteranganCivitas'],
        ]);

        return redirect()->route('master.civitas')->with('success', "Civitas $mci_name_request berhasil diperbarui");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterCivitas  $masterCivitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $hasCivitas = MasterMember::where('mci_id', $id)->exists();
        $civitas = MasterCivitas::where('mci_id', $id)->firstOrFail();
        $name = $civitas->mci_name;

        if ($hasCivitas){
            return redirect()->route('master.civitas')->with('error', "Civitas $name tidak dapat dihapus karena terdapat pengguna yang terdaftar di civitas tersebut");
        }
        
        MasterCivitas::where('mci_id', $id)->delete();

        return redirect()->route('master.civitas')->with('success', "Civitas $name berhasil dihapus");
    }
}
