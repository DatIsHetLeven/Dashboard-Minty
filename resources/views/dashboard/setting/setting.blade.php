@extends('layouts.navAdmin')
@section('content')

<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">

<div class="item1">
    <h2>Producten</h2>
    Alle producten op Factuursturen
        <a href = "{{ route('alleproducten') }}"><input type="button" id="inputBtn" value="Bekijk producten"></a>
</div>




@endsection