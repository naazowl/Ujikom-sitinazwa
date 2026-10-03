@extends('layouts.admin')

@section('title', 'Tambah Foto Baru - Admin Portal')

@section('content')

<div class="admin-form-card">
    <h2 class="admin-form-title">Tambah Foto Baru</h2>
    <p class="admin-form-desc">Unggah foto kegiatan atau fasilitas sekolah untuk ditampilkan di galeri website.</p>

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.galeri._form')
    </form>
</div>

@endsection