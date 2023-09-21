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

        $pekerjaanOrangtua = new PekerjaanOrangtua();
        $pekerjaanOrangtua->nama_pekerjaan = $request->nama_pekerjaan;
        $pekerjaanOrangtua->save();

        Alert::success('Sukses', 'Simpan Data Sukses');
        return redirect()->route('pekerjaan_ortu.index');
    }

    public function edit($id)
    {
        $data = PekerjaanOrangtua::find($id);
        return view('pages.pekerjaan_ortu.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
        ]);

        $pekerjaanOrangtua = PekerjaanOrangtua::find($id);
        $pekerjaanOrangtua->nama_pekerjaan = $request->nama_pekerjaan;
        $pekerjaanOrangtua->save();

        Alert::success('Sukses', 'Edit Data Sukses');
        return redirect()->route('pekerjaan_ortu.index');
    }

    public function destroy($id)
    {
        $pekerjaanOrangtua = PekerjaanOrangtua::findOrFail($id);
        $pekerjaanOrangtua->delete();

        Alert::success('Sukses', 'Hapus Data Sukses');
        return redirect()->route('pekerjaan_ortu.index');
    }
}
