@extends('layouts.admin')

@section('title', 'Edit Foto - Admin Portal')

@section('content')

<div class="admin-form-card">
    <h2 class="admin-form-title">Edit Foto</h2>
    <p class="admin-form-desc">Perbarui foto yang sudah ditampilkan di galeri website.</p>

    <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
        @include('admin.galeri._form')
    </form>
</div>

@endsection