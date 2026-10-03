<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $jurusans = Jurusan::orderBy('kode')->get();

        $kategoriAktif = $request->get('jurusan', $jurusans->first()?->kode);
        $search        = $request->get('search');

        $produks = Produk::where('kategori', $kategoriAktif)
            ->when($search, fn ($q) => $q->where('nama', 'like', "%{$search}%"))
            ->orderByDesc('tanggal')
            ->get();

        return view('admin.produk.index', compact('produks', 'jurusans', 'kategoriAktif', 'search'));
    }

    public function create()
    {
        $jurusans = Jurusan::orderBy('kode')->get();

        return view('admin.produk.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validasi($request);

        $validated['slug'] = Str::slug($validated['nama']) . '-' . strtolower($validated['kategori']) . '-' . uniqid();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->uploadGambar($request->file('gambar'));
        }

        Produk::create($validated);

        return redirect()
            ->route('admin.produk.index', ['jurusan' => $validated['kategori']])
            ->with('success', 'Produk baru berhasil ditambahkan.')
            ->with('toast_type', 'create');
    }

    public function edit($id)
    {
        $produk   = Produk::findOrFail($id);
        $jurusans = Jurusan::orderBy('kode')->get();

        return view('admin.produk.edit', compact('produk', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $this->validasi($request);

        $adaGambarBaru = false;

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($produk->gambar);
            $validated['gambar'] = $this->uploadGambar($request->file('gambar'));
            $adaGambarBaru = true;
        }

        $produk->fill($validated);

        $adaPerubahan = $produk->isDirty() || $adaGambarBaru;

        $produk->save();

        if (!$adaPerubahan) {
            return redirect()->route('admin.produk.index', ['jurusan' => $produk->kategori]);
        }

        return redirect()
            ->route('admin.produk.index', ['jurusan' => $produk->kategori])
            ->with('success', 'Perubahan pada produk berhasil disimpan.')
            ->with('toast_type', 'update');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = $produk->kategori;

        $this->hapusGambar($produk->gambar);
        $produk->delete();

        return redirect()
            ->route('admin.produk.index', ['jurusan' => $kategori])
            ->with('success', 'Produk berhasil dihapus.')
            ->with('toast_type', 'delete');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'kategori'          => 'required|string|exists:jurusan,kode',
            'kategori_produk'   => 'nullable|string|max:255',
            'nama'              => 'required|string|max:255',
            'deskripsi_lengkap' => 'required|string',
            'tanggal'           => 'required|date',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);
    }

    private function uploadGambar($file): string
    {
        $folder = public_path('images/produk');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $filename);

        return $filename;
    }

    private function hapusGambar(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = public_path('images/produk/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}