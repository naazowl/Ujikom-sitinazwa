@extends('layouts.admin')

@section('title', 'Tambah Jurusan Baru - Admin Portal')

@section('content')

<div class="admin-form-card">
    <h2 class="admin-form-title">Tambah Jurusan Baru</h2>
    <p class="admin-form-desc">Tambahkan data program keahlian baru beserta detail deskripsi, logo, dan prospeknya.</p>

    <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.jurusan._form')
    </form>
</div>

@endsection