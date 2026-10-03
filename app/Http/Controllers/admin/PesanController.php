<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pesans = Pesan::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('isi', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->get();

        return view('admin.pesan.index', compact('pesans', 'search'));
    }

    public function baca($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->update(['sudah_dibaca' => true]);

        return back();
    }

    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()
            ->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus.')
            ->with('toast_type', 'delete');
    }
}