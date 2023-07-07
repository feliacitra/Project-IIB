<?php

namespace App\Http\Controllers;

use App\Models\MasterMember;
use Illuminate\Http\Request;
use App\Models\MasterProgramInkubasi;


class MasterProgramInkubasiController extends Controller
{

    public function index(){
        $inkubasi = MasterProgramInkubasi::latest('updated_at');

        if (request('search')){
            $inkubasi->where('mpi_name', 'like', '%'.request('search').'%')
                ->orWhere('mpi_description', 'like', '%'.request('search').'%');
        }

        return view('Master-ProgramInkubasi.listProgramInkubasi', [
            "master_programinkubasi" => $inkubasi->get(),
        ]);
    }

    public function create(){


    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'addNamaInkubasi' => 'required|max:255|unique:master_programinkubasi,mpi_name',
            'addDeskripsiInkubasi' => 'nullable',
            'addStatus' => 'required',
        ], [
            'addNamaInkubasi.required' => 'Nama Program Inkubasi tidak boleh kosong',
            'addNamaInkubasi.unique' => 'Nama Program Inkubasi sudah digunakan',
        ]);

        MasterProgramInkubasi::create([
            'mpi_name' => $validatedData['addNamaInkubasi'],
            'mpi_description' => $validatedData['addDeskripsiInkubasi'],
            'mpi_type' => $validatedData['addStatus']
        ]);

        $nama = $request->input('addNamaInkubasi');

        return redirect()->route('master.inkubasi')->with('success', "Program Inkubasi $nama berhasil ditambah");
    }

    public function show(MasterProgramInkubasi $masterProgramInkubasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterProgramInkubasi  $masterProgramInkubasi
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterProgramInkubasi $masterProgramInkubasi)
    {
        //
    }

    //
    // public function tambah_program(Request $request){

    //     $this->validate(
    //         $request, 
    //         ['mpi_name' => 'unique:master_programinkubasi|required',
    //          'mpi_description' => 'required',
    //          'mpi_type' => 'required',],
    //         ['mpi_name.unique' => 'The Incubation Program Name Has Already Been Taken!',
    //          'mpi_name.required' => 'The Incubation Program Name Is Required!',
    //          'mpi_description.required' => 'The Incubation Program Description Is Required!',
    //         ]

    //     );

    //     MasterProgramInkubasi::create($request->post());
    //     return redirect()->route('incubationProgram')->with('success', 'Program telah ditambahkan');
    // }

    public function destroy(int $id)
    {
        $hasInkubasi = MasterMember::where('mpi_id', $id)->exists();
        $Inkubasi = MasterProgramInkubasi::where('mpi_id', $id)->firstOrFail();
        $name = $Inkubasi->mpi_name;
        
        if ($hasInkubasi){
            return redirect()->route('master.inkubasi')->withErrors("Program inkubasi $name tidak dapat dihapus karena terdapat pengguna yang terdaftar di Inkubasi tersebut");
        }
        
        MasterProgramInkubasi::where('mpi_id', $id)->delete();

        return redirect()->route('master.inkubasi')->with('success', "Program inkubasi $name berhasil dihapus");
    }

    public function update(Request $request, int $id){

        $mpi = MasterProgramInkubasi::where('mpi_id', $id)->firstOrFail();
        $mpi_name = $mpi->mpi_name;
        $mpi_name_request = $request->input('editNamaInkubasi');

        $rules = [
            'editNamaInkubasi' => 'required',
            'editDeskripsiInkubasi' => 'nullable',
            'editStatus' => 'required',
        ];

        if ($request->input('editNamaInkubasi') != $mpi->mpi_name) {
            $rules['editNamaInkubasi'] = 'required|unique:master_programinkubasi,mpi_name';
        }

        $validatedData = $request->validate($rules, [
            'editNamaInkubasi.required' => "Gagal memperbarui Program Inkubasi $mpi_name, Nama Program Inkubasi tidak boleh kosong",
            'editNamaInkubasi.unique' => "Gagal memperbarui Program Inkubasi $mpi_name, Nama Program Inkubasi $mpi_name_request sudah digunakan",
        ]);

        MasterProgramInkubasi::where('mpi_id', $id)->update([
            'mpi_name' => $validatedData['editNamaInkubasi'],
            'mpi_description' => $validatedData['editDeskripsiInkubasi'],
            'mpi_type' => $validatedData['editStatus'],
        ]);

        return redirect()->route('master.inkubasi')->with('success', "Program inkubasi $mpi_name_request berhasil diperbarui");
    }

 
}
