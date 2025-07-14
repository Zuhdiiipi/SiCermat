@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Wilayah</h3>
    <form action="{{ route('regions.update', $region) }}" method="POST">
        @method('PUT')
        @include('regions.form')
    </form>
</div>
@endsection
