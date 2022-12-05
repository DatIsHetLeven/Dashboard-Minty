@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
@section('content')


<div class="container my-5">
    <div class="card xborder-0 my-3">
        <h5 class="card-header xbg-white">
            Google Authenticator
        </h5>
        <?php
        $google2fa = new \PragmaRX\Google2FA\Google2FA();
        $secret = $google2fa->generateSecretKey();
        ?>
        <form class="card-body" method="POST" action="{{ route('AuthRequest', $secret) }}">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Stap 1</label>
                <div class="col-sm">
                    Download Google Authentication via de App store of Google Play op jou smartphone.
                </div>
            </div>




            <div class="form-group row">
                @csrf
                <label class="col-sm-2 col-form-label">Stap 2</label>
                <label class="col-sm col-form-label">
                    <div>Scan de barcode of voer de 'secret key' via de app.</div>
                    <div class="mt-2">
                        <span class="text-danger">Secret key: <?php echo $secret ?></span>
                    </div>
                    <div>
                    <?php
                    $google2fa = new \PragmaRX\Google2FA\Google2FA();

                    $text = $google2fa->getQRCodeUrl(
                    'Bol Koppeling',
                    '(Minty Media)',
                    $secret
                    );

                    $image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$text;
                    echo '<img src="'.$image_url.'" />';
                    ?>
                    </div>

                    <div>

            </div>
                </label>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Stap 3</label>
                <div class="col-sm">
                    Voer de gegenereerde 2FA code uit de app hier in en klik op verifieren.
                    <div>
                        <input type="text" name="userInputAuth" required/>
                        <button type="submit" name="btnVerif" class="btn btn-primary">verifieren</button>
                    </div>
                </div>
            </div>
            </div></form></div></div>
{{--    <?php--}}

{{--    $user_provided_code = "353536";--}}
{{--    $google2fa = new \PragmaRX\Google2FA\Google2FA();--}}
{{--    if ($google2fa->verifyKey($secret, $user_provided_code)) {--}}

{{--        dd("test");--}}
{{--// Code is valid--}}
{{--    } else {--}}
{{--        dd("nee");--}}
{{--        // Code is NOT valid--}}
{{--    }--}}

{{--        ?>--}}




