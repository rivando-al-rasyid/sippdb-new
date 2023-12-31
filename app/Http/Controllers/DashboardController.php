<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

// Load Models
use App\Models\User;
use App\Models\Hasil;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $items = Hasil::with(['peserta.orang_tua'])->get();

        // Count
        $count_user = User::all()->count();
        $count_all_peserta = Hasil::all()->count();
        $count_menunggu_peserta = Hasil::where('status', 'MENUNGGU')->count();
        $count_ditolak_peserta = Hasil::where('status', 'DITOLAK')->count();
        $count_diterima_peserta = Hasil::where('status', 'DITERIMA')->count();


        return view('admin.dashboard.index', compact(
            'items',
            'count_user',
            'count_all_peserta',
            'count_menunggu_peserta',
            'count_ditolak_peserta',
            'count_diterima_peserta'
        ));
    }

    public function detail($id)
    {
        $item = Hasil::with(['peserta.orang_tua'])->where('id', $id)->first();
        return view('admin.dashboard.detail', compact('item'));
    }

    public function terima($id)
    {
        $item = Hasil::findOrFail($id);

        $item->status = 'DITERIMA';
        $item->update();

        Alert::success('Sukses', 'Simpan Data Sukses');
        return redirect()->route('home');
    }

    public function tolak($id)
    {
        $item = Hasil::findOrFail($id);

        $item->status = 'DITOLAK';
        $item->update();

        Alert::success('Sukses', 'Simpan Data Sukses');
        return redirect()->route('home');
    }
}
