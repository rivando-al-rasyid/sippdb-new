<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator; // Add this line
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Modules\TUS\Models\TU as ModelsTU;

class KelolaController extends Controller
{
    public function index()
    {
        $items = ModelsTU::all();
        return view('pages.user.index', compact('items'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ // Remove the backslash before Validator
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:t_u'], // Change users to t_u
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Please check your form');
            return back()->withErrors($validator)->withInput();
        }

        ModelsTU::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Alert::success('Success', 'Data saved successfully');
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $data = ModelsTU::find($id);

        return view('pages.user.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ // Remove the backslash before Validator
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:t_u,email,' . $id], // Change users to t_u
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Please check your form');
            return back()->withErrors($validator)->withInput();
        }

        $tu = ModelsTU::find($id);
        $tu->name = $request->name;
        $tu->email = $request->email;
        $tu->password = Hash::make($request->password);
        $tu->save();

        Alert::success('Success', 'Data updated successfully');
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $tu = ModelsTU::findOrFail($id);
        $tu->delete();
        Alert::success('Success', 'Data deleted successfully');
        return redirect()->route('user.index');
    }
}
