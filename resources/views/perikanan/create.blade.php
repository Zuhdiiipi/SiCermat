@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Komoditas</h3>
    <form action="{{ route('perikanan.store') }}" method="POST" enctype="multipart/form-data">
        @include('perikanan.form')
    </form>
</div>
@endsection
