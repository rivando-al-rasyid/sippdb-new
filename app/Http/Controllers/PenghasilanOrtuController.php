<?php

namespace App\Http\Controllers;

use App\Models\PenghasilanOrtu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenghasilanOrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = PenghasilanOrtu::all();
        return view('admin.penghasilan_ortu.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penghasilan_ortu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penghasilan_ortu' => 'required',
        ]);

        $penghasilanOrtu = new PenghasilanOrtu();
        $penghasilanOrtu->penghasilan_ortu = $request->penghasilan_ortu;
        $penghasilanOrtu->save();

        Alert::success('Success', 'Data Saved Successfully');
        return redirect()->route('penghasilan_ortu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenghasilanOrtu $penghasilanOrtu)
    {
        // Implementation for showing a specific resource
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenghasilanOrtu $penghasilanOrtu)
    {
        $data = PenghasilanOrtu::find($id);
        return view('admin.penghasilan_ortu.edit', compact('penghasilanOrtu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenghasilanOrtu $penghasilanOrtu)
    {
        $request->validate([
            'penghasilan_ortu' => 'required',
        ]);

        $penghasilanOrtu->penghasilan_ortu = $request->penghasilan_ortu;
        $penghasilanOrtu->save();

        Alert::success('Success', 'Data Updated Successfully');
        return redirect()->route('penghasilan_ortu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenghasilanOrtu $penghasilanOrtu)
    {
        $penghasilanOrtu->delete();

        Alert::success('Success', 'Data Deleted Successfully');
        return redirect()->route('penghasilan_ortu.index');
    }
}
