<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterProgramInkubasi;
use Illuminate\Support\Facades\DB;


class MasterProgramInkubasiController extends Controller
{
    //
    public function tambah_program(Request $request){

        $this->validate(
            $request, 
            ['mpi_name' => 'unique:master_programinkubasi|required',
             'mpi_description' => 'required',
             'mpi_type' => 'required',],
            ['mpi_name.unique' => 'The Incubation Program Name Has Already Been Taken!',
             'mpi_name.required' => 'The Incubation Program Name Is Required!',
             'mpi_description.required' => 'The Incubation Program Description Is Required!',
            ]

        );

        MasterProgramInkubasi::create($request->post());
        return redirect()->route('incubationProgram')->with('success', 'Program telah ditambahkan');
    }

    public function destroy($id){
        
        DB::table('master_programinkubasi')->where('id',$id)->delete();
        return redirect()->route('incubationProgram')->with('success', 'Program Telah Dihapus');

    }

    public function update(Request $request, $mpi_id){

        $this->validate(
            $request, 
            ['mpi_name' => 'unique:master_programinkubasi|required',
             'mpi_description' => 'required',
             'mpi_type' => 'required',],
            ['mpi_name.unique' => 'The Incubation Program Name Has Already Been Taken!',
             'mpi_name.required' => 'The Incubation Program Name Is Required!',
             'mpi_description.required' => 'The Incubation Program Description Is Required!',
            ]

        );
        
        $mpi = MasterProgramInkubasi::find($mpi_id);
        $mpi->mpi_name = $request->mpi_name;
        $mpi->mpi_description = $request->mpi_description;
        $mpi->mpi_type = $request->mpi_type;
        $mpi->save();

        return redirect()->route('incubationProgram')->with('success', 'Program Berhasil Diupdate!');
    }
}
