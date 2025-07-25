@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Komoditas</h3>
    <form action="{{ route('pertanian.update', $commodity->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('pertanian.form')
    </form>
</div>
@endsection
