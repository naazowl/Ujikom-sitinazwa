<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $informasis = Informasi::when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%");
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        return view('admin.informasi.index', compact('informasis', 'search'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string',
            'tanggal'  => 'required|date',
            'kategori' => 'required|in:Prestasi,Kegiatan,Berita',
            'status'   => 'required|in:Publik,Draft',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $validated['slug'] = Str::slug($validated['judul']) . '-' . uniqid();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->uploadGambar($request->file('gambar'));
        }

        Informasi::create($validated);

        return redirect()
            ->route('admin.informasi.index')
            ->with('success', 'Berita baru berhasil dipublikasikan.')
            ->with('toast_type', 'create');
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);

        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string',
            'tanggal'  => 'required|date',
            'kategori' => 'required|in:Prestasi,Kegiatan,Berita',
            'status'   => 'required|in:Publik,Draft',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $adaFotoBaru = false;

        if ($request->hasFile('gambar')) {
            $this->deleteGambar($informasi->gambar);
            $validated['gambar'] = $this->uploadGambar($request->file('gambar'));
            $adaFotoBaru = true;
        }

        $informasi->fill($validated);

        $adaPerubahan = $informasi->isDirty() || $adaFotoBaru;

        $informasi->save();

        if (!$adaPerubahan) {
            return redirect()->route('admin.informasi.index');
        }

        return redirect()
            ->route('admin.informasi.index')
            ->with('success', 'Perubahan pada berita berhasil disimpan.')
            ->with('toast_type', 'update');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);

        $this->deleteGambar($informasi->gambar);
        $informasi->delete();

        return redirect()
            ->route('admin.informasi.index')
            ->with('success', 'Berita berhasil dihapus dari daftar.')
            ->with('toast_type', 'delete');
    }

    private function uploadGambar($file): string
    {
        $folder = public_path('images/informasi');

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

        $path = public_path('images/informasi/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}