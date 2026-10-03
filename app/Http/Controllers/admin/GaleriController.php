<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $galeris = Galeri::when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%");
            })
            ->orderByDesc('tanggal')
            ->get();

        return view('admin.galeri.index', compact('galeris', 'search'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:Publik,Draft',
            'gambar'     => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $validated['gambar'] = $this->uploadGambar($request->file('gambar'));

        Galeri::create($validated);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto baru berhasil ditambahkan ke galeri.')
            ->with('toast_type', 'create');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);

        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul'      => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:Publik,Draft',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $adaFotoBaru = false;

        if ($request->hasFile('gambar')) {
            $this->deleteGambar($galeri->gambar);
            $validated['gambar'] = $this->uploadGambar($request->file('gambar'));
            $adaFotoBaru = true;
        }

        $galeri->fill($validated);

        $adaPerubahan = $galeri->isDirty() || $adaFotoBaru;

        $galeri->save();

        if (!$adaPerubahan) {
            return redirect()->route('admin.galeri.index');
        }

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Perubahan pada foto berhasil disimpan.')
            ->with('toast_type', 'update');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        $this->deleteGambar($galeri->gambar);
        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto berhasil dihapus dari galeri.')
            ->with('toast_type', 'delete');
    }

    private function uploadGambar($file): string
    {
        $folder = public_path('images/galeri');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $filename);

        return $filename;
    }

    private function deleteGambar(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = public_path('images/galeri/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}