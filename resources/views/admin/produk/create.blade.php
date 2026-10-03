@extends('layouts.admin')

@section('title', 'Tambah Produk Baru - Admin Portal')

@section('content')

<div class="admin-form-card">
    <h2 class="admin-form-title">Tambah Produk Baru</h2>
    <p class="admin-form-desc">Isi detail produk karya siswa untuk ditampilkan di katalog website.</p>

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.produk._form')
    </form>
</div>

@endsection