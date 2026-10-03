@csrf
@isset($produk)
    @method('PUT')
@endisset

<div class="admin-form-grid">

    <div class="admin-form-col-upload">
        <label class="admin-upload-box" id="uploadBox">
            <input type="file" name="gambar" id="gambarInput" accept=".jpg,.jpeg,.png,.webp" hidden>

            <div id="uploadPreviewWrap">
                @isset($produk)
                    @if ($produk->gambar)
                        <img src="{{ asset('images/produk/'.$produk->gambar) }}" id="uploadPreview" class="admin-upload-preview">
                    @endif
                @endisset

                <div id="uploadPlaceholder" @isset($produk) @if($produk->gambar) style="display:none" @endif @endisset>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <strong>Unggah atau Seret File Di Sini</strong>
                    <small>Mendukung JPG, PNG, atau WEBP (Maks. 10MB)</small>
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
            Pilih File Foto
        </button>
    </div>

    <div class="admin-form-col-fields">

        <div class="admin-field">
            <label for="nama">Nama Produk</label>
            <input type="text" name="nama" id="nama" placeholder="e.g., Custom Lanyard PMR"
                   value="{{ old('nama', $produk->nama ?? '') }}">
            @error('nama') <div class="admin-field-error">{{ $message }}</div> @enderror
        </div>

        <div class="admin-field-row">
            <div class="admin-field">
                <label for="kategori">Kategori (Jurusan)</label>
                <select name="kategori" id="kategori">
                    <option value="">Pilih Jurusan</option>
                    @foreach ($jurusans as $j)
                        <option value="{{ $j->kode }}"
                            {{ old('kategori', $produk->kategori ?? '') === $j->kode ? 'selected' : '' }}>
                            {{ $j->kode }} - {{ $j->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori') <div class="admin-field-error">{{ $message }}</div> @enderror
            </div>

            <div class="admin-field">
                <label for="kategori_produk">Kategori Produk</label>
                <input type="text" name="kategori_produk" id="kategori_produk" placeholder="e.g., Aksesoris & Kerajinan"
                       value="{{ old('kategori_produk', $produk->kategori_produk ?? '') }}">
                @error('kategori_produk') <div class="admin-field-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="admin-field">
            <label for="deskripsi_lengkap">Deskripsi Lengkap</label>
            <textarea name="deskripsi_lengkap" id="deskripsi_lengkap" placeholder="Deskripsi lengkap produk (tampil di halaman detail)...">{{ old('deskripsi_lengkap', $produk->deskripsi_lengkap ?? '') }}</textarea>
            @error('deskripsi_lengkap') <div class="admin-field-error">{{ $message }}</div> @enderror
        </div>

        <div class="admin-field">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal"
                   value="{{ old('tanggal', isset($produk) ? $produk->tanggal->format('Y-m-d') : date('Y-m-d')) }}">
            @error('tanggal') <div class="admin-field-error">{{ $message }}</div> @enderror
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

            <a href="{{ route('admin.produk.index') }}" class="admin-btn-cancel">
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
    const uploadBox    = document.getElementById('uploadBox');
    const gambarInput  = document.getElementById('gambarInput');
    const previewWrap  = document.getElementById('uploadPreviewWrap');
    const placeholder  = document.getElementById('uploadPlaceholder');
    const pilihFileBtn = document.getElementById('pilihFileBtn');

    function renderPreview(file) {
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            let img = document.getElementById('uploadPreview');
            if (!img) {
                img = document.createElement('img');
                img.id = 'uploadPreview';
                img.className = 'admin-upload-preview';
                previewWrap.prepend(img);
            }
            img.src = e.target.result;
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    pilihFileBtn.addEventListener('click', () => gambarInput.click());

    gambarInput.addEventListener('change', () => {
        renderPreview(gambarInput.files[0]);
    });

    uploadBox.addEventListener('dragover', (e) => e.preventDefault());

    uploadBox.addEventListener('drop', (e) => {
        e.preventDefault();
        const file = e.dataTransfer.files[0];
        if (file) {
            gambarInput.files = e.dataTransfer.files;
            renderPreview(file);
        }
    });
</script>