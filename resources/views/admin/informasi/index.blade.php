@extends('layouts.admin')

@section('title', 'Kelola Informasi & Berita - Admin Portal')

@section('content')

<h2 class="admin-section-title">Kelola Informasi &amp; Berita</h2>


<div class="admin-toolbar">
    <a href="{{ route('admin.informasi.create') }}" class="admin-btn-add">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Berita Baru
    </a>

    <form method="GET" action="{{ route('admin.informasi.index') }}" class="admin-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari Berita...">
    </form>
</div>

<div class="admin-table-wrap">
    <table class="admin-table admin-informasi-table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Judul Artikel</th>
                <th class="admin-date-column">Tanggal</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($informasis as $item)
                <tr>
                    <td>
                        <img
                            src="{{ $item->gambar ? asset('images/informasi/'.$item->gambar) : asset('images/no-image.png') }}"
                            alt=""
                            class="admin-thumb"
                        >
                    </td>

                    <td><span class="admin-judul-text">{{ $item->judul }}</span></td>

                    <td class="text-center admin-date-column">
                        {{ $item->tanggal->format('d-m-Y') }}
                    </td>

                    <td>
                        <span class="admin-badge admin-badge-{{ strtolower($item->kategori) }}">
                            {{ $item->kategori }}
                        </span>
                    </td>

                    <td>{{ $item->status }}</td>

                    <td>
                        <div class="admin-table-actions">
                            <a href="{{ route('admin.informasi.edit', $item->id) }}" class="admin-action-edit">Edit</a>

                            <form action="{{ route('admin.informasi.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-action-hapus">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="admin-empty-row">
                    <td colspan="6">Belum ada berita.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection