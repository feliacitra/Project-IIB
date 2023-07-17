<?php

namespace App\Http\Controllers;

use App\Models\MasterPeriode;
use Illuminate\Http\Request;

class MasterPeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = MasterPeriode::latest('updated_at');

        if (request('search')){
            $periods->where('mpe_name', 'like', '%'.request('search').'%')
                ->orWhere('mpe_description', 'like', '%'.request('search').'%');
        }

        return view('Master-PeriodePendaftaran.listPeriodePendaftaran', [
            "periods" => $periods->get(),
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
        $namaPeriode = $request->input('addNamaPeriode');
        
        $validatedData = $request->validate([
            'addNamaPeriode' => 'required|max:255|unique:master_periode,mpe_name',
            'addTanggalMulai' => 'required|date',
            'addTanggalSelesai' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = $request->input('addTanggalMulai');
                    $endDate = $request->input('addTanggalSelesai');

                    if ($startDate >= $endDate) {
                        $fail(':attribute tidak boleh kurang dari tanggal mulai');
                    }
                },
            ],
            'addKeteranganPeriode' => 'nullable',
            'addStatusPeriode' => 'required',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah digunakan',
            'date' => ':attribute tidak valid',
        ], [
            'addNamaPeriode' => 'Nama periode',
            'addTanggalMulai' => 'Tanggal mulai',
            'addTanggalSelesai' => 'Tanggal akhir',
            'addKeteranganPeriode' => 'Keterangan periode',
            'addStatusPeriode' => 'Status periode',
        ]);

        MasterPeriode::create([
            'mpe_name' => $validatedData['addNamaPeriode'],
            'mpe_startdate' => $validatedData['addTanggalMulai'],
            'mpe_enddate' => $validatedData['addTanggalSelesai'],
            'mpe_status' => $validatedData['addStatusPeriode'],
            'mpe_description' => $validatedData['addKeteranganPeriode'],
        ]);

        return redirect()->route('master.periode')->with('success', "Periode $namaPeriode berhasil ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterPeriode  $masterPeriode
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPeriode $masterPeriode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPeriode  $masterPeriode
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPeriode $masterPeriode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPeriode  $masterPeriode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $period = MasterPeriode::where('mpe_id', $id)->firstOrFail();

        $rules = [
            'editNamaPeriode' => 'required|max:255',
            'editTanggalMulai' => 'required|date',
            'editTanggalAkhir' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = $request->input('editTanggalMulai');
                    $endDate = $request->input('editTanggalAkhir');

                    if ($startDate >= $endDate) {
                        $fail(':attribute tidak boleh kurang dari tanggal mulai');
                    }
                },
            ],
            'editKeteranganPeriode' => 'nullable',
            'editStatusPeriode' => 'required',
            
        ];

        if ($request->editNamaPeriode != $period->mpe_name)
        {
            $rules['editNamaPeriode'] = 'required|max:255|unique:master_periode,mpe_name';
        }

        $validatedData = $request->validate($rules, [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah digunakan',
            'date' => ':attribute tidak valid',
        ], [
            'editNamaPeriode' => 'Nama periode',
            'editTanggalMulai' => 'Tanggal mulai',
            'editTanggalAkhir' => 'Tanggal akhir',
            'editKeteranganPeriode' => 'Keterangan periode',
            'editStatusPeriode' => 'Status periode',
        ]);

        MasterPeriode::where('mpe_id', $id)->update([
            'mpe_name' => $validatedData['editNamaPeriode'],
            'mpe_startdate' => $validatedData['editTanggalMulai'],
            'mpe_enddate' => $validatedData['editTanggalAkhir'],
            'mpe_description' => $validatedData['editKeteranganPeriode'],
            'mpe_status' => $validatedData['editStatusPeriode'],
        ]);

        return redirect()->route('master.periode')->with('success', "Periode $period->mpe_name berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPeriode  $masterPeriode
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $period = MasterPeriode::where('mpe_id', $id)->firstOrFail();
        $name = $period->mpe_name;

        MasterPeriode::where('mpe_id', $id)->delete();
        return redirect()->route('master.periode')->with('success', "Periode $name berhasil dihapus");
    }
}
