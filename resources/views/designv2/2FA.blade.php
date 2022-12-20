@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
@section('content')

<style>
    .card p {
        font-size: 15px;
        line-height: 1.8em;
        color: rgb(136, 136, 136);
    }
    input[type="text"] {
        width: 100%!important;
        line-height: 1em!important;
        height: 45px!important;
        padding: 0px 15px!important;
        border: 1px solid #d2d2d2!important;
        border-radius: 4px!important;
        font-size: 13px!important;
    }
</style>


<div class="main-grid-min-nav">
    <div class="wrapped-container">
<div class="WelkomBanner">
        <h2>2FA</h2>
        <p><span class="welkomBol">Om zeker te zijn dat alleen jij kan inloggen</span></p>
    </div>


<div class="">
    <div class="card">
        <h5 class="card-header">
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
                    <p>Download Google Authentication via de App store of Google Play op jou smartphone.</p>
                </div>
            </div>




            <div class="form-group row">
                @csrf
                <label class="col-sm-2 col-form-label">Stap 2</label>
                <label class="col-sm col-form-label">
                    <p>Scan de barcode of voer de 'secret key' via de app.</p>
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
                    <p>Voer de gegenereerde 2FA code uit de app hier in en klik op verifieren.</p>
                    <div>
                        <input type="text" name="userInputAuth" required/>
                        
                        <div class="button-footer"><button type="submit" name="btnVerif" class="btn btn-primary">verifieren</button></div>
                    </div>
                </div>
            </div>
            </div></form></div></div>



                </div>
                </div>


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




