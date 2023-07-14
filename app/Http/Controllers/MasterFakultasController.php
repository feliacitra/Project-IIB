<?php

namespace App\Http\Controllers;

use App\Models\MasterFakultas;
use App\Models\MasterUniversitas;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class MasterFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $universities = MasterUniversitas::all();
        $faculties = MasterFakultas::all();

        if (request('search')) {
            $searchTerm = request('search');

            $faculties = $faculties->filter(function ($faculty) use ($searchTerm) {
                return stripos($faculty->mf_name, $searchTerm) !== false
                    || stripos($faculty->mf_description, $searchTerm) !== false;
            });
        }


        return view('Master-Fakultas.listFakultas', compact('universities', 'faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $universitas = MasterUniversitas::pluck('mu_name', 'mu_id');
        return view('fakultas.create', compact('universitas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'addNamaFakultas' => 'required|max:255|unique:master_fakultas,mf_name',
            'addSelectedUniversity' => 'required|exists:master_universitas,mu_id',
            'addKeteranganFakultas' => 'nullable',
        ],[
            'addNamaFakultas.required' => 'Nama fakultas tidak boleh kosong',
            'addNamaFakultas.unique' => 'Nama fakultas sudah digunakan'
        ]);

        MasterFakultas::create([
            'mf_name' => $validatedData['addNamaFakultas'],
            'mu_id' => $validatedData['addSelectedUniversity'],
            'mf_description' => $validatedData['addKeteranganFakultas']
        ]);

        return redirect()->route('faculty.index')
            ->with('success', 'Faculty created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $fakultas = MasterFakultas::findOrFail($id);
        return view('fakultas.show', compact('fakultas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $fakultas = MasterFakultas::findOrFail($id);
        $universitas = MasterUniversitas::pluck('mu_name', 'mu_id');
        return view('fakultas.edit', compact('fakultas', 'universitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $mf = MasterFakultas::where('mf_id', $id)->firstOrFail();
        $mf_name = $mf->mf_name;
        $mf_name_request = $request->input('editNamaFakultas');

        $rules = [
            'editNamaFakultas' => 'required',
            'editKeteranganFakultas' => 'required',
        ];

        if ($request->input('editNamaFakultas') != $mf->mf_name) {
            $rules['editNamaFakultas'] = 'required|unique:master_fakultas,mf_name';
        }

        $validatedData = $request->validate($rules, [
            'editNamaFakultas.required' => "Gagal memperbarui fakultas $mf_name, Nama fakultas tidak boleh kosong",
            'editNamaFakultas.unique' => "Gagal memperbarui fakultas $mf_name, Nama fakultas $mf_name_request sudah digunakan",
        ]);

        MasterFakultas::where('mf_id', $id)->update([
            'mf_name' => $validatedData['editNamaFakultas'],
            'mf_description' => $validatedData['editKeteranganFakultas'],
        ]);

        return redirect()->route('faculty.index')
            ->with('success', 'Faculty updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $fakultas = MasterFakultas::findOrFail($id);
        $fakultas->delete();

        return redirect()->route('faculty.index')
            ->with('success', 'Faculty deleted successfully.');
    }
}
