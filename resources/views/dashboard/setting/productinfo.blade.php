<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@extends('layouts.nav')
@section('content')

<div class="container rounded bg-white mt-5 mb-5">
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="row mt-2">
                  <form method="POST" action="{{ route('updatePoduct',$productInfo->id) }}">
                  @csrf
                    <div class="col-md-6"><label class="labels">Productnaam</label><input type="text" name="code" class="form-control" value="<?php echo $productInfo->code?>"></div>
                    <div class="col-md-6"><label class="labels">ProductCode</label><input type="text" name="name" class="form-control" value="<?php echo $productInfo->name ?>"></div>
                    <div class="col-md-6"><label class="labels">Prijs excl. btw</label><input type="text" name="price" class="form-control" value="<?php echo $productInfo->price?>"></div>
                    <div class="col-md-6"><label class="labels">Btw %</label><input type="text" name="taxes" class="form-control" value="<?php echo $productInfo->taxes ?>"></div> 
                </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="btnUpdateProduct">Opslaan</button></div>
                  </form>
            </div>
        </div>
    </div>
</div>

@endsection