<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\PekerjaanOrangtua;

class PekerjaanOrangtuaController extends Controller
{
    public function index()
    {
        $items = PekerjaanOrangtua::all();
        return view('admin.pekerjaan_ortu.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pekerjaan_ortu.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
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
        $data = PekerjaanOrangtua::find($id);
        return view('admin.pekerjaan_ortu.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'nama_pekerjaan' => 'required',
        ]);

        $query = PekerjaanOrangtua::find($id);

        if ($query) {
            $query->update(['nama_pekerjaan' => $request->nama_pekerjaan]);
            Alert::success('Sukses', 'Edit Data Sukses');
            return redirect()->route('pekerjaan_ortu.index');
        }

        Alert::error('Error', 'Data not found');
        return back();
    }

    public function destroy($id)
    {
        $query = PekerjaanOrangtua::findOrFail($id);
        $query->delete();
        Alert::success('Sukses', 'Hapus Data Sukses');
        return redirect()->route('pekerjaan_ortu.index');
    }
}
