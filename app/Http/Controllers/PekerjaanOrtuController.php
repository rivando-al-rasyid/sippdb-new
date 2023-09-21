<?php

namespace App\Http\Controllers;

use App\Models\PekerjaanOrtu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PekerjaanOrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = PekerjaanOrtu::all();
        return view('admin.pekerjaan_ortu.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pekerjaan_ortu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
        ]);

        $pekerjaanOrtu = new PekerjaanOrtu();
        $pekerjaanOrtu->nama_pekerjaan = $request->nama_pekerjaan;
        $pekerjaanOrtu->save();

        Alert::success('Success', 'Data Saved Successfully');
        return redirect()->route('pekerjaan_ortu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PekerjaanOrtu $pekerjaanOrtu)
    {
        // Implementation for showing a specific resource
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PekerjaanOrtu $pekerjaanOrtu)
    {
        return view('admin.pekerjaan_ortu.edit', compact('pekerjaanOrtu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PekerjaanOrtu $pekerjaanOrtu)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
        ]);

        $pekerjaanOrtu->nama_pekerjaan = $request->nama_pekerjaan;
        $pekerjaanOrtu->save();

        Alert::success('Success', 'Data Updated Successfully');
        return redirect()->route('pekerjaan_ortu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PekerjaanOrtu $pekerjaanOrtu)
    {
        $pekerjaanOrtu->delete();

        Alert::success('Success', 'Data Deleted Successfully');
        return redirect()->route('pekerjaan_ortu.index');
    }
}
