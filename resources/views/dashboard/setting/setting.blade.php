@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Beheer</title>
@section('content')

<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">


<div class="main-grid-min-nav">
    <div class="wrapped-container">
<div class="WelkomBanner">
        <h2>Beheer</h2>
        <p><span class="welkomBol">Hier kunnen dingen worden aangepast zoals prijs van de koppeling.</span></p>
    </div>

<div class="col-md-6">
<div class="Card">
    <div class="card-header">Prijs</div>
    <div class="card-body">
   <p>Nieuwe prijs is alleen voor nieuwe klanten</p>


    <form method="POST" action="{{ route('veranderPrijs') }}" >
        @csrf
        <!-- Form Group (username)-->
            <label class="small mb-1 label-inputs" for="inputUsername">Prijs (€)</label>
            <input class="form-control" id="inputUsername" name='newPrijs' value="<?php echo $bolPrijs->bolPrijs ?>" type="double" >
        
        <div class="button-footer" >
            <button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">Aanpassen</button></a>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>



@endsection
