@extends('layouts.admin')

@section('title', 'Tambah Berita Baru - Admin Portal')

@section('content')

<div class="admin-form-card">
    <h2 class="admin-form-title">Tambah Berita Baru</h2>
    <p class="admin-form-desc">Tulis dan publikasikan berita, informasi, atau kegiatan terbaru di website.</p>

    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.informasi._form')
    </form>
</div>

@endsection