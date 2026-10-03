@extends('layouts.admin')

@section('title', 'Edit Jurusan - Admin Portal')

@section('content')

<div class="admin-form-card">
    <h2 class="admin-form-title">Edit Jurusan</h2>
    <p class="admin-form-desc">Perbarui data program keahlian yang sudah tersimpan.</p>

    <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
        @include('admin.jurusan._form')
    </form>
</div>

@endsection