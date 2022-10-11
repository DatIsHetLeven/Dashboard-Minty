<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


@extends('layouts.navAdmin')
@section('content')

<div class="alleProducten" class="overlay">
  <div class="table-pos">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Product</th>
                <th>ProductNaam</th>
            </tr>
        </thead>
    <tbody><?php
    $count = 0;
    for ($x = 0; $x < count($alleProducten); $x++) {?>
      <div class="perGeberuiker" value={{$count}}>
        <tr>
            <td><a href="{{ route('productinfo',$alleProducten[$x]->id) }}"><?php echo $alleProducten[$x]->code; ?></a></td>    
            <td><a href="{{ route('productinfo',$alleProducten[$x]->id) }}"><?php echo $alleProducten[$x]->name; ?></td>
        </tr>
      </div>
        <?php
        }?></tbody></table>
</div>
</div>

@endsection