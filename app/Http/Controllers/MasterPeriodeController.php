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
        //
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
