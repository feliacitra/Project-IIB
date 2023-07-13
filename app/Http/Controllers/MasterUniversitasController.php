<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterUniversitas; 
use App\Models\MasterMember; 
use App\Models\MasterFakultas; 

class MasterUniversitasController extends Controller
{
    public function index()
    {
        $universitas = MasterUniversitas::latest('updated_at');

        if (request('search')){
            $universitas->where('mu_name', 'like', '%'.request('search').'%')
                ->orWhere('mu_description', 'like', '%'.request('search').'%');
        }

        return view('Master-Universitas.listUniversitas', [
            "master_universitas" => $universitas->get(),
        ]);
    }

    //
    public function create(){


    }


 public function store(Request $request)
    {
        $validatedData = $request->validate([
            'addNamaUniversitas' => 'required|max:255|unique:master_universitas,mu_name',
            'addDeskripsiUniversitas' => 'nullable'
        ], [
            'addNamaUniversitas.required' => 'Nama universitas tidak boleh kosong',
            'addNamaUniversitas.unique' => 'Nama universitas sudah digunakan',
        ]);

        MasterUniversitas::create([
            'mu_name' => $validatedData['addNamaUniversitas'],
            'mu_description' => $validatedData['addDeskripsiUniversitas'],
        ]);

        $nama = $request->input('addNamaUniversitas');

        return redirect()->route('master.universitas')->with('success', "Universitas $nama berhasil ditambah");
    }


    public function show(MasterUniversitas $masterUniversitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterUniversitas  $masterUniversitas
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterUniversitas $masterUniversitas)
    {
        //
    }


    public function destroy(int $id)
    {
      $hasUniversitas = MasterMember::where('mu_id', $id)->exists();
      $hasFakultas = MasterFakultas::where('mu_id', $id)->exists();
        $universitas = MasterUniversitas::where('mu_id', $id)->firstOrFail();
        $name = $universitas->mu_name;
        
        if ($hasUniversitas){
            return redirect()->route('master.universitas')->withErrors("Universitas $name tidak dapat dihapus karena terdapat pengguna yang terdaftar di universitas tersebut");
        }

        if ($hasFakultas){
            return redirect()->route('master.universitas')->withErrors("Universitas $name tidak dapat dihapus karena terdapat fakultas yang terdaftar di universitas tersebut");
        }
        
        MasterUniversitas::where('mu_id', $id)->delete();

        return redirect()->route('master.universitas')->with('success', "Universitas $name berhasil dihapus");
    }

    public function update(Request $request, int $id){
        $mu = MasterUniversitas::where('mu_id', $id)->firstOrFail();
        $mu_name = $mu->mu_name;
        $mu_name_request = $request->input('editNamaUniversitas');

        $rules = [
            'editNamaUniversitas' => 'required',
            'editDeskripsiUniversitas' => 'nullable',
        ];

        if ($request->input('editNamaUniversitas') != $mu->mu_name) {
            $rules['editNamaUniversitas'] = 'required|unique:master_universitas,mu_name';
        }

        $validatedData = $request->validate($rules, [
            'editNamaUniversitas.required' => "Gagal memperbarui Nama Universitas $mu_name, Nama Universitas tidak boleh kosong",
            'editNamaUniversitas.unique' => "Gagal memperbarui Program Inkubasi $mu_name, Nama Universitas $mu_name_request sudah digunakan",
        ]);

        MasterUniversitas::where('mu_id', $id)->update([
            'mu_name' => $validatedData['editNamaUniversitas'],
            'mu_description' => $validatedData['editDeskripsiUniversitas'],
        ]);

        return redirect()->route('master.universitas')->with('success', "Universitas $mu_name_request berhasil diperbarui");
    }


}
