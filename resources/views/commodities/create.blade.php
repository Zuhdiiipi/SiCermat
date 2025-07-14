@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Komoditas</h3>
    <form action="{{ route('commodities.store') }}" method="POST">
        @include('commodities.form')
    </form>
</div>
@endsection
