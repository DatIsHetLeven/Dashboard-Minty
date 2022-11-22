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

<div class="item1">
    <?php
    $google2fa = new \PragmaRX\Google2FA\Google2FA();
    $secret = $google2fa->generateSecretKey();
    echo $secret;


    $google2fa = new \PragmaRX\Google2FA\Google2FA();

    $text = $google2fa->getQRCodeUrl(
        'example.com',
        'hans',
        $secret
    );

    $image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$text;
    echo '<img src="'.$image_url.'" />';
// Now store the key in your database





    ?>
</div>





@endsection
