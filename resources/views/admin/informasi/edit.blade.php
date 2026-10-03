@extends('layouts.admin')

@section('title', 'Edit Berita - Admin Portal')

@section('content')

<div class="admin-form-card">
    <h2 class="admin-form-title">Edit Berita</h2>
    <p class="admin-form-desc">Perbarui informasi berita yang sudah dipublikasikan.</p>

    <form action="{{ route('admin.informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
        @include('admin.informasi._form')
    </form>
</div>

@endsection