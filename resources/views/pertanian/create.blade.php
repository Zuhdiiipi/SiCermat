@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Komoditas</h3>
    <form action="{{ route('pertanian.store') }}" method="POST" enctype="multipart/form-data">
        @include('pertanian.form')
    </form>
</div>
@endsection
