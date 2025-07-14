@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Komoditas</h3>
    <form action="{{ route('commodities.update', $commodity) }}" method="POST">
        @method('PUT')
        @include('commodities.form')
    </form>
</div>
@endsection
