<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use Illuminate\Http\Request;

class MasterCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = MasterCategory::latest('updated_at');

        if (request('search')){
            $categories->where('mc_name', 'like', '%'.request('search').'%')
                ->orWhere('mc_description', 'like', '%'.request('search').'%');
        }

        return view('Master-KategoriStartup.listKategoriStartup', [
            "categories" => $categories->get(),
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
            'addNamaKategori' => 'required|max:255|unique:master_categories,mc_name',
            'addKeteranganKategori' => 'nullable|max:255',
            'addStatusKategori' => 'required',
        ], [
            'addNamaKategori.required' => 'Nama kategori tidak boleh kosong',
            'addNamaKategori.unique' => 'Nama kategori sudah digunakan',
            'addStatusKategori.required' => 'Status kategori tidak boleh kosong'
        ]);

        MasterCategory::create([
            'mc_name' => $validatedData['addNamaKategori'],
            'mc_description' => $validatedData['addKeteranganKategori'],
            'mc_status' => $validatedData['addStatusKategori'],
        ]);

        $nama = $request->input('addNamaCivitas');

        return redirect()->route('master.kategori.startup')->with('success', "Kategori $nama berhasil ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterCategory  $masterCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCategory $masterCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterCategory  $masterCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCategory $masterCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterCategory  $masterCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $category = MasterCategory::where('mc_id', $id)->firstOrFail();

        $rules = [
            'editNamaKategori' => 'required|max:255',
            'editKeteranganKategori' => 'nullable|max:255',
            'editStatusKategori' => 'required',
        ];

        if($request->editNamaKategori != $category->mc_name){
            $rules['editNamaKategori'] = 'required|unique:master_categories,mc_name';
        }

        $validatedData = $request->validate($rules, [
            'editNamaKategori.required' => "Gagal memperbarui kategori $category->mc_name, Nama kategori tidak boleh kosong",
            'editNamaKategori.unique' => "Gagal memperbarui kategori $category->mc_name, Nama kategori $category->mc_name sudah digunakan",
            'editStatusKategori.required' => "Gagal memperbarui kategori $category->mc_name, Status kategori tidak boleh kosong",
        ]);

        MasterCategory::where('mc_id', $id)->update([
            'mc_name' => $validatedData['editNamaKategori'],
            'mc_description' => $validatedData['editKeteranganKategori'],
            'mc_status' => $validatedData['editStatusKategori'],
        ]);

        return redirect()->route('master.kategori.startup')->with('success', "Kategori $category->mc_name berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterCategory  $masterCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        // $hasCivitas = ::where('mc_id', $id)->exists();
        
        $category = MasterCategory::where('mc_id', $id)->firstOrFail();
        $name = $category->mc_name;

        // if ($hasCivitas){
        //     return redirect()->route('master.civitas')->with('error', "Civitas $name tidak dapat dihapus karena terdapat pengguna yang terdaftar di civitas tersebut");
        // }

        MasterCategory::where('mc_id', $id)->delete();

        return redirect()->route('master.kategori.startup')->with('success', "Kategori $name berhasil dihapus");
    }
}
