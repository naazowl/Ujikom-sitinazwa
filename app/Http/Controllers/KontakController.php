<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = [
            'alamat' => 'Jalan Raya Tajur, Kp. Buntar RT 02/RW 08, Kelurahan Muarasari, Kecamatan Bogor Selatan, Kota Bogor, Jawa Barat, 16137.',
            'telepon' => '+62 822 6016 8886',
            'email' => 'smkn4@smkn4bogor.sch.id',
            'youtube' => '@smknegeri4bogor905',
            'facebook' => 'SMK NEGERI 4 KOTA BOGOR',
            'instagram' => '@smkn4kotabogor',
            'maps_embed' => 'https://www.google.com/maps?q=SMKN+4+Bogor&output=embed',
        ];

        return view('kontak', compact('kontak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'telepon' => 'nullable|regex:/^[0-9]+$/|max:20',
            'isi'     => 'required|string|max:2000',
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'isi.required'   => 'Pesan wajib diisi.',
            'telepon.regex'  => 'Nomor telepon hanya boleh berisi angka.',
        ]);

        Pesan::create($request->only('nama', 'email', 'telepon', 'isi'));

        return back()->with('kontak_success', 'Pesan Anda berhasil terkirim. Terima kasih!');
    }
}