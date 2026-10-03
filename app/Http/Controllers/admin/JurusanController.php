<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $jurusans = Jurusan::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('kode', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->get();

        return view('admin.jurusan.index', compact('jurusans', 'search'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validasi($request);

        $validated['prestasi']       = $this->bersihkanList($request->input('prestasi', []));
        $validated['prospek_karier'] = $this->bersihkanList($request->input('prospek_karier', []));

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->uploadFile($request->file('logo'), 'logo');
        }

        if ($request->hasFile('foto_kegiatan')) {
            $validated['foto_kegiatan'] = $this->uploadFile($request->file('foto_kegiatan'), 'kegiatan');
        }

        Jurusan::create($validated);

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Jurusan baru berhasil ditambahkan.')
            ->with('toast_type', 'create');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $validated = $this->validasi($request, $jurusan->id);

        $validated['prestasi']       = $this->bersihkanList($request->input('prestasi', []));
        $validated['prospek_karier'] = $this->bersihkanList($request->input('prospek_karier', []));

        $adaFileBaru = false;

        if ($request->hasFile('logo')) {
            $this->hapusFile($jurusan->logo, 'logo');
            $validated['logo'] = $this->uploadFile($request->file('logo'), 'logo');
            $adaFileBaru = true;
        }

        if ($request->hasFile('foto_kegiatan')) {
            $this->hapusFile($jurusan->foto_kegiatan, 'kegiatan');
            $validated['foto_kegiatan'] = $this->uploadFile($request->file('foto_kegiatan'), 'kegiatan');
            $adaFileBaru = true;
        }

        $jurusan->fill($validated);

        $adaPerubahan = $jurusan->isDirty() || $adaFileBaru;

        $jurusan->save();

        if (!$adaPerubahan) {
            return redirect()->route('admin.jurusan.index');
        }

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Perubahan pada jurusan berhasil disimpan.')
            ->with('toast_type', 'update');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $this->hapusFile($jurusan->logo, 'logo');
        $this->hapusFile($jurusan->foto_kegiatan, 'kegiatan');
        $jurusan->delete();

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.')
            ->with('toast_type', 'delete');
    }

    private function validasi(Request $request, $ignoreId = null): array
    {
        return $request->validate([
            'kode'          => 'required|string|max:20|unique:jurusan,kode' . ($ignoreId ? ",{$ignoreId}" : ''),
            'nama'          => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'foto_kegiatan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);
    }

    private function bersihkanList(array $items): array
    {
        return array_values(array_filter(array_map('trim', $items), fn ($item) => $item !== ''));
    }

    private function uploadFile($file, string $subfolder): string
    {
        $folder = public_path('images/jurusan/' . $subfolder);

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $filename);

        return $filename;
    }

    private function hapusFile(?string $filename, string $subfolder): void
    {
        if (!$filename) {
            return;
        }

        $path = public_path('images/jurusan/' . $subfolder . '/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}