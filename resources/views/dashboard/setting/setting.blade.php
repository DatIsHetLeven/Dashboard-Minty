@extends( 'layouts.navBarAdmin')
<title>Beheer</title>
@section('content')

<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">



<div class="item1">
    <h2>Prijs</h2>
    Voer nieuw prijs in:<br>
    Let wel : Dit geldt alleen voor nieuwe klanten.<br>


    <form method="POST" action="{{ route('veranderPrijs') }}" >
        @csrf
        <!-- Form Group (username)-->
        <div class="mb-3">
            <label class="small mb-1" for="inputUsername">Prijs</label>
            <input class="form-control" id="inputUsername" name='newPrijs' type="double" >
        </div>
        <br>
        <button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">Aanpassen</button></a>
    </form>
</div>

<div class="item1">
    <h2>Bol prijs : </h2>
        <div class="mb-3">
            <input class="form-control" id="inputUsername" name='newPrijs' type="double" value="<?php echo $bolPrijs->bolPrijs ?>" readonly >
        </div>
</div>






@endsection
