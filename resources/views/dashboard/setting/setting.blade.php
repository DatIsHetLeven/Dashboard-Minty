@extends( 'layouts.navBarAdmin')
@section('content')

<link href="{{ asset('css/setting/setting.css') }}" rel="stylesheet">



<div class="item1">
    <h2>Prijs</h2>
    Voer nieuw prijs in:


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




@endsection
