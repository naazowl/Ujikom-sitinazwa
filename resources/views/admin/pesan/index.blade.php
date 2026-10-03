@extends('layouts.admin')

@section('title', 'Pesan Masuk - Admin Portal')

@section('content')

<h2 class="admin-section-title">Pesan Masuk</h2>

<div class="admin-toolbar">
    <form method="GET" action="{{ route('admin.pesan.index') }}" class="admin-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, email, atau isi pesan...">
    </form>
</div>

<div class="admin-table-wrap">
    <table class="admin-table admin-pesan-table">
        <thead>
            <tr>
                <th class="text-center">Status</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Pesan</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pesans as $item)
                <tr @if (!$item->sudah_dibaca) style="background-color:#F0F7FF;" @endif>
                    <td class="text-center">
                        @if ($item->sudah_dibaca)
                            <span class="admin-badge admin-badge-berita">Sudah dibaca</span>
                        @else
                            <span class="admin-badge admin-badge-prestasi">Baru</span>
                        @endif
                    </td>

                    <td>{{ $item->nama }}</td>

                    <td>
                        {{ $item->email }}
                        @if ($item->telepon)
                            <br><span style="color:var(--color-text-muted);font-size:12px;">{{ $item->telepon }}</span>
                        @endif
                    </td>

                    <td>{{ Str::limit($item->isi, 90) }}</td>

                    <td class="text-center">{{ $item->created_at->format('d-m-Y') }}</td>

                    <td class="text-center">
                        <div class="admin-table-actions">
                            @unless ($item->sudah_dibaca)
                                <form action="{{ route('admin.pesan.baca', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="admin-action-edit">Tandai Dibaca</button>
                                </form>
                            @endunless

                            <form action="{{ route('admin.pesan.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus pesan dari {{ $item->nama }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-action-hapus">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="admin-empty-row">
                    <td colspan="6">Belum ada pesan masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection