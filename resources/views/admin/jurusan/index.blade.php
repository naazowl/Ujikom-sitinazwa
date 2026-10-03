@extends('layouts.admin')

@section('title', 'Kelola Jurusan - Admin Portal')

@section('content')

<h2 class="admin-section-title">Kelola Jurusan</h2>

<div class="admin-toolbar">
    <a href="{{ route('admin.jurusan.create') }}" class="admin-btn-add">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Jurusan Baru
    </a>
</div>

<div class="admin-table-wrap">
    <table class="admin-table admin-jurusan-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Logo</th>
                <th>Jurusan</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($jurusans as $index => $item)

                <tr
                    class="admin-jurusan-row"
                    ondblclick="bukaPreviewJurusan(this)"
                    data-logo="{{ $item->logo ? asset('images/jurusan/logo/'.$item->logo) : '' }}"
                    data-kode="{{ $item->kode }}"
                    data-nama="{{ $item->nama }}"
                    data-deskripsi="{{ $item->deskripsi }}"
                    data-foto="{{ $item->foto_kegiatan ? asset('images/jurusan/kegiatan/'.$item->foto_kegiatan) : '' }}"
                    data-prestasi="{{ json_encode($item->prestasi ?? []) }}"
                    data-prospek="{{ json_encode($item->prospek_karier ?? []) }}"
                >

                    <td>{{ $index + 1 }}</td>

                    <td>
                        <img
                            src="{{ $item->logo ? asset('images/jurusan/logo/'.$item->logo) : asset('images/no-image.png') }}"
                            alt=""
                            class="admin-thumb"
                        >
                    </td>

                    <td>
                        <div class="admin-jurusan-info">
                            <div class="admin-jurusan-text">
                                <strong>{{ $item->kode }}</strong><br>
                                {{ $item->nama }}
                            </div>
                        </div>
                    </td>

                    <td>{{ Str::limit($item->deskripsi, 90) }}</td>

                    <td>
                        <div class="admin-table-actions">

                            <a
                                href="{{ route('admin.jurusan.edit', $item->id) }}"
                                class="admin-action-edit"
                                onclick="event.stopPropagation();"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.jurusan.destroy', $item->id) }}"
                                method="POST"
                                onclick="event.stopPropagation();"
                                onsubmit="return confirm('Yakin ingin menghapus jurusan \'{{ $item->nama }}\'? Tindakan ini tidak dapat dibatalkan.');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="admin-action-hapus"
                                >
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @empty

                <tr class="admin-empty-row">
                    <td colspan="5">Belum ada data jurusan.</td>
                </tr>

            @endforelse
        </tbody>
    </table>
</div>


{{-- MODAL PREVIEW --}}
<div
    class="admin-modal-overlay"
    id="previewOverlay"
    onclick="if(event.target === this) tutupPreviewJurusan()"
>
    <div class="admin-modal">

        <div class="admin-modal-header">

            <div class="admin-modal-logo" id="previewLogoWrap">
                <img src="" alt="" id="previewLogo" style="display:none;">
            </div>

            <div class="admin-modal-header-text">
                <h3 id="previewKode">-</h3>
                <p id="previewNama">-</p>
            </div>

            <button
                type="button"
                class="admin-modal-close"
                onclick="tutupPreviewJurusan()"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="16"
                     height="16"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2.5"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>

        </div>

        <div class="admin-modal-body">

            <div class="admin-modal-section">
                <h4>Deskripsi</h4>
                <p id="previewDeskripsi">-</p>
            </div>

            <div class="admin-modal-section">
                <h4>Foto Kegiatan</h4>
                <div id="previewFotoWrap"></div>
            </div>

            <div class="admin-modal-section">
                <h4>Daftar Prestasi</h4>

                <div class="admin-modal-prestasi-grid">
                    <ul
                        class="admin-modal-list"
                        id="previewPrestasi"
                    ></ul>
                </div>
            </div>

            <div class="admin-modal-section">
                <h4>Prospek Karier</h4>

                <div class="admin-modal-prospek-grid">
                    <ul
                        class="admin-modal-list"
                        id="previewProspek"
                    ></ul>
                </div>
            </div>

        </div>

    </div>
</div>


<script>
    function bukaPreviewJurusan(row) {
        const d = row.dataset;

        document.getElementById('previewKode').textContent = d.kode;
        document.getElementById('previewNama').textContent = d.nama;
        document.getElementById('previewDeskripsi').textContent = d.deskripsi;

        const logoImg = document.getElementById('previewLogo');

        if (d.logo) {
            logoImg.src = d.logo;
            logoImg.style.display = 'block';
        } else {
            logoImg.src = '';
            logoImg.style.display = 'none';
        }

        const fotoWrap = document.getElementById('previewFotoWrap');

        if (d.foto) {
            fotoWrap.innerHTML = `
                <img
                    src="${d.foto}"
                    class="admin-modal-photo"
                    alt="Foto kegiatan ${d.kode}"
                >
            `;
        } else {
            fotoWrap.innerHTML = `
                <div class="admin-modal-photo-empty">
                    Belum ada foto kegiatan
                </div>
            `;
        }

        let prestasi = [];

        try {
            prestasi = JSON.parse(d.prestasi || '[]');
        } catch (error) {
            prestasi = [];
        }

        const prestasiList = document.getElementById('previewPrestasi');

        prestasiList.innerHTML = prestasi.length
            ? prestasi.map(p => `<li>${p}</li>`).join('')
            : `<li class="admin-modal-empty-text">Belum ada data prestasi</li>`;

        let prospek = [];

        try {
            prospek = JSON.parse(d.prospek || '[]');
        } catch (error) {
            prospek = [];
        }

        const prospekList = document.getElementById('previewProspek');

        prospekList.innerHTML = prospek.length
            ? prospek.map(p => `<li>${p}</li>`).join('')
            : `<li class="admin-modal-empty-text">Belum ada data prospek karier</li>`;

        document.getElementById('previewOverlay').classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function tutupPreviewJurusan() {
        document.getElementById('previewOverlay').classList.remove('is-open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            tutupPreviewJurusan();
        }
    });
</script>

@endsection