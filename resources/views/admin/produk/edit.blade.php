@extends('layouts.admin')

@section('title', 'Edit Produk - Admin Portal')

@section('content')

<div class="admin-form-card">
    <h2 class="admin-form-title">Edit Produk</h2>
    <p class="admin-form-desc">Perbarui detail produk yang sudah tersimpan.</p>

    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @include('admin.produk._form')
    </form>
</div>

@endsection