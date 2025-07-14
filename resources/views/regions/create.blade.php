@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Wilayah</h3>
    <form action="{{ route('regions.store') }}" method="POST">
        @include('regions.form')
    </form>
</div>
@endsection
