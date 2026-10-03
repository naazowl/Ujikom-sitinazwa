@extends('layouts.admin')

@section('title', 'Kelola Galeri - Admin Portal')

@section('content')

<h2 class="admin-section-title">Kelola Galeri</h2>

<div class="admin-toolbar">
    <a href="{{ route('admin.galeri.create') }}" class="admin-btn-add">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Foto Baru
    </a>

    <form action="{{ route('admin.galeri.index') }}" method="GET" class="admin-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" name="search" placeholder="Cari Foto..." value="{{ $search }}">
    </form>
</div>

<div class="admin-table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul Foto</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($galeris as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>

                    <td>
                        <img
                            src="{{ $item->gambar ? asset('images/galeri/'.$item->gambar) : asset('images/no-image.png') }}"
                            alt=""
                            class="admin-thumb"
                        >
                    </td>

                    <td>{{ $item->judul }}</td>

                    <td class="text-center">{{ $item->tanggal->format('d-m-Y') }}</td>

                    <td class="text-center">{{ $item->status }}</td>

                    <td class="text-center">
                        <div class="admin-table-actions" style="justify-content:center;">
                            <a href="{{ route('admin.galeri.edit', $item->id) }}" class="admin-action-edit">Edit</a>

                            <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus foto \'{{ $item->judul }}\'? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-action-hapus">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="admin-empty-row">
                    <td colspan="6">Belum ada foto di galeri.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection