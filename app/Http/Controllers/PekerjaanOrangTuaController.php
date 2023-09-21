<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PekerjaanOrangtua;
use RealRashid\SweetAlert\Facades\Alert;

class PekerjaanOrangtuaController extends Controller
{
    public function index()
    {
        $items = PekerjaanOrangtua::all();
        return view('pages.pekerjaan_ortu.index', compact('items'));
    }

    public function create()
    {
        return view('pages.pekerjaan_ortu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
        ]);

        PekerjaanOrangtua::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
        ]);

        Alert::success('Sukses', 'Simpan Data Sukses');
        return redirect()->route('pekerjaan_ortu.index');
    }

    public function edit($id)
    {
        $data = PekerjaanOrangtua::findOrFail($id);
        return view('pages.pekerjaan_ortu.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
        ]);

        $pekerjaan = PekerjaanOrangtua::findOrFail($id);
        $pekerjaan->nama_pekerjaan = $request->nama_pekerjaan;
        $pekerjaan->save();

        Alert::success('Sukses', 'Edit Data Sukses');
        return redirect()->route('pekerjaan_ortu.index');
    }

    public function destroy($id)
    {
        $pekerjaan = PekerjaanOrangtua::findOrFail($id);
        $pekerjaan->delete();

        Alert::success('Sukses', 'Hapus Data Sukses');
        return redirect()->route('pekerjaan_ortu.index');
    }
}
