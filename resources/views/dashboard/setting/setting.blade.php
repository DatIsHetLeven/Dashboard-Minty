@extends('layouts.nav')
@section('content')

<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">

<div class="item1">
    <h2>Producten</h2>
    Alles producten op Factuursturen
        <a href = "{{ route('alleproducten') }}"><input type="button" id="inputBtn" value="Bekijk producten"></a>
</div>

@endsection