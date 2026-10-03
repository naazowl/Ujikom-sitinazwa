@csrf
@isset($jurusan)
    @method('PUT')
@endisset

<div class="admin-form-grid">

    <div class="admin-form-col-upload">
        <label class="admin-upload-box" id="uploadBox">
            <input type="file" name="logo" id="logoInput" accept=".jpg,.jpeg,.png,.svg,.webp" hidden>

            <div id="uploadPreviewWrap">
                @isset($jurusan)
                    @if ($jurusan->logo)
                        <img src="{{ asset('images/jurusan/logo/'.$jurusan->logo) }}" id="uploadPreview" class="admin-upload-preview">
                    @endif
                @endisset

                <div id="uploadPlaceholder" @isset($jurusan) @if($jurusan->logo) style="display:none" @endif @endisset>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <strong>Unggah Logo Jurusan</strong>
                    <small>PNG / SVG transparan (Maks. 2MB)</small>
                </div>
            </div>
        </label>

        <button type="button" class="admin-btn-upload admin-btn-upload-full" id="pilihFileBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                <polyline points="17 8 12 3 7 8"/>
                <line x1="12" y1="3" x2="12" y2="15"/>
            </svg>
            Pilih File Logo
        </button>
    </div>

    <div class="admin-form-col-fields">

        <div class="admin-field">
            <label for="kode">Kode Jurusan</label>
            <input type="text" name="kode" id="kode" placeholder="e.g., PPLG"
                   value="{{ old('kode', $jurusan->kode ?? '') }}">
            @error('kode') <div class="admin-field-error">{{ $message }}</div> @enderror
        </div>

        <div class="admin-field">
            <label for="nama">Nama Program Keahlian</label>
            <input type="text" name="nama" id="nama" placeholder="e.g., Pengembangan Perangkat Lunak dan Gim"
                   value="{{ old('nama', $jurusan->nama ?? '') }}">
            @error('nama') <div class="admin-field-error">{{ $message }}</div> @enderror
        </div>

        <div class="admin-field">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" placeholder="Jelaskan program keahlian ini...">{{ old('deskripsi', $jurusan->deskripsi ?? '') }}</textarea>
            @error('deskripsi') <div class="admin-field-error">{{ $message }}</div> @enderror
        </div>

        <div class="admin-field-row">

            <div class="admin-field">
                <label>Daftar Prestasi (Opsional)</label>

                <div class="admin-repeat-list" id="prestasiList">
                    @php $prestasiLama = old('prestasi', $jurusan->prestasi ?? []); @endphp

                    @forelse ($prestasiLama as $poin)
                        <div class="admin-repeat-item">
                            <input type="text" name="prestasi[]" value="{{ $poin }}" placeholder="e.g., Juara 1 LKS Tingkat Kota Bogor">
                            <button type="button" class="admin-repeat-remove" onclick="this.parentElement.remove()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div class="admin-repeat-item">
                            <input type="text" name="prestasi[]" placeholder="e.g., Juara 1 LKS Tingkat Kota Bogor">
                            <button type="button" class="admin-repeat-remove" onclick="this.parentElement.remove()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                            </button>
                        </div>
                    @endforelse
                </div>

                <button type="button" class="admin-repeat-add" onclick="tambahItem('prestasiList', 'prestasi[]', 'e.g., Juara 1 LKS Tingkat Kota Bogor')">
                    + Tambah Prestasi
                </button>
            </div>

            <div class="admin-field">
                <label>Prospek Karier</label>

                <div class="admin-repeat-list" id="prospekList">
                    @php $prospekLama = old('prospek_karier', $jurusan->prospek_karier ?? []); @endphp

                    @forelse ($prospekLama as $poin)
                        <div class="admin-repeat-item">
                            <input type="text" name="prospek_karier[]" value="{{ $poin }}" placeholder="e.g., Software Engineer">
                            <button type="button" class="admin-repeat-remove" onclick="this.parentElement.remove()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div class="admin-repeat-item">
                            <input type="text" name="prospek_karier[]" placeholder="e.g., Software Engineer">
                            <button type="button" class="admin-repeat-remove" onclick="this.parentElement.remove()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                            </button>
                        </div>
                    @endforelse
                </div>

                <button type="button" class="admin-repeat-add" onclick="tambahItem('prospekList', 'prospek_karier[]', 'e.g., Software Engineer')">
                    + Tambah Prospek
                </button>
            </div>

        </div>

        <div class="admin-field">
            <label>Foto Kegiatan (ditampilkan di halaman detail jurusan)</label>

            <label class="admin-upload-box" id="uploadBoxKegiatan" style="min-height:160px;">
                <input type="file" name="foto_kegiatan" id="kegiatanInput" accept=".jpg,.jpeg,.png,.webp" hidden>

                <div id="uploadPreviewWrapKegiatan">
                    @isset($jurusan)
                        @if ($jurusan->foto_kegiatan)
                            <img src="{{ asset('images/jurusan/kegiatan/'.$jurusan->foto_kegiatan) }}" id="uploadPreviewKegiatan" class="admin-upload-preview">
                        @endif
                    @endisset

                    <div id="uploadPlaceholderKegiatan" @isset($jurusan) @if($jurusan->foto_kegiatan) style="display:none" @endif @endisset>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" y1="3" x2="12" y2="15"/>
                        </svg>
                        <strong>Unggah Foto Kegiatan</strong>
                        <small>JPG, PNG, atau WEBP (Maks. 10MB)</small>
                    </div>
                </div>
            </label>

            <button type="button" class="admin-btn-upload admin-btn-upload-full" id="pilihFileKegiatanBtn" style="margin-top:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                Pilih File Foto Kegiatan
            </button>
        </div>

        <div class="admin-form-buttons">
            <button type="submit" class="admin-btn-save">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Simpan
            </button>

            <a href="{{ route('admin.jurusan.index') }}" class="admin-btn-cancel">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
                Batal
            </a>
        </div>

    </div>

</div>

<script>
    // ---- Logo ----
    const uploadBox    = document.getElementById('uploadBox');
    const logoInput    = document.getElementById('logoInput');
    const previewWrap  = document.getElementById('uploadPreviewWrap');
    const placeholder  = document.getElementById('uploadPlaceholder');
    const pilihFileBtn = document.getElementById('pilihFileBtn');

    function renderPreview(input, wrap, placeholderEl, previewId, file) {
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            let img = document.getElementById(previewId);
            if (!img) {
                img = document.createElement('img');
                img.id = previewId;
                img.className = 'admin-upload-preview';
                wrap.prepend(img);
            }
            img.src = e.target.result;
            placeholderEl.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    pilihFileBtn.addEventListener('click', () => logoInput.click());
    logoInput.addEventListener('change', () => renderPreview(logoInput, previewWrap, placeholder, 'uploadPreview', logoInput.files[0]));
    uploadBox.addEventListener('dragover', (e) => e.preventDefault());
    uploadBox.addEventListener('drop', (e) => {
        e.preventDefault();
        const file = e.dataTransfer.files[0];
        if (file) {
            logoInput.files = e.dataTransfer.files;
            renderPreview(logoInput, previewWrap, placeholder, 'uploadPreview', file);
        }
    });

    // ---- Foto Kegiatan ----
    const uploadBoxKegiatan    = document.getElementById('uploadBoxKegiatan');
    const kegiatanInput        = document.getElementById('kegiatanInput');
    const previewWrapKegiatan  = document.getElementById('uploadPreviewWrapKegiatan');
    const placeholderKegiatan  = document.getElementById('uploadPlaceholderKegiatan');
    const pilihFileKegiatanBtn = document.getElementById('pilihFileKegiatanBtn');

    pilihFileKegiatanBtn.addEventListener('click', () => kegiatanInput.click());
    kegiatanInput.addEventListener('change', () => renderPreview(kegiatanInput, previewWrapKegiatan, placeholderKegiatan, 'uploadPreviewKegiatan', kegiatanInput.files[0]));
    uploadBoxKegiatan.addEventListener('dragover', (e) => e.preventDefault());
    uploadBoxKegiatan.addEventListener('drop', (e) => {
        e.preventDefault();
        const file = e.dataTransfer.files[0];
        if (file) {
            kegiatanInput.files = e.dataTransfer.files;
            renderPreview(kegiatanInput, previewWrapKegiatan, placeholderKegiatan, 'uploadPreviewKegiatan', file);
        }
    });

    // ---- Tambah item dinamis (prestasi/prospek) ----
    function tambahItem(listId, inputName, placeholderText) {
        const list = document.getElementById(listId);

        const item = document.createElement('div');
        item.className = 'admin-repeat-item';
        item.innerHTML = `
            <input type="text" name="${inputName}" placeholder="${placeholderText}">
            <button type="button" class="admin-repeat-remove" onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        `;

        list.appendChild(item);
        item.querySelector('input').focus();
    }
</script>