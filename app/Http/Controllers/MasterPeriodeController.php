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
            'addTanggalSelesai' => 'required|date',
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
    public function update(Request $request, MasterPeriode $masterPeriode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPeriode  $masterPeriode
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPeriode $masterPeriode)
    {
        //
    }
}
