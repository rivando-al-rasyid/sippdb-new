<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenghasilanOrangtua;
use RealRashid\SweetAlert\Facades\Alert;


class PenghasilanOrangtuaController extends Controller
{
    public function index()
    {
        $items = PenghasilanOrangtua::all();
        return view('admin.penghasilan_ortu.index', compact('items'));
    }

    public function create()
    {
        return view('admin.penghasilan_ortu.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'penghasilan_ortu' => 'required',
        ]);

        PenghasilanOrangtua::create([
            'penghasilan_ortu' => $request->penghasilan_ortu,
        ]);

        Alert::success('Sukses', 'Simpan Data Sukses');
        return redirect()->route('penghasilan_ortu.index');
    }

    public function edit($id)
    {
        $data = PenghasilanOrangtua::find($id);
        return view('admin.penghasilan_ortu.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'penghasilan_ortu' => 'required',
        ]);

        $query = PenghasilanOrangtua::find($id);

        if ($query) {
            $query->update(['penghasilan_ortu' => $request->penghasilan_ortu]);
            Alert::success('Sukses', 'Edit Data Sukses');
            return redirect()->route('penghasilan_ortu.index');
        }

        Alert::error('Error', 'Data not found');
        return back();
    }

    public function destroy($id)
    {
        $query = PenghasilanOrangtua::findOrFail($id);
        $query->delete();
        Alert::success('Sukses', 'Hapus Data Sukses');
        return redirect()->route('penghasilan_ortu.index');
    }
}
