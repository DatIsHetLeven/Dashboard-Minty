@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Beveiligen</title>
@section('content')

    <style>
        .reset-password .card {
            max-width: 340px;
        }
        .col-md-6.col-center {
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            justify-content: center;
            color: #fff;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8em;
        }
        .col-center h4 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }
    </style>

<div class="main-grid-min-nav">
    <div class="wrapped-container">
<div class="WelkomBanner">
        <h2>Beveiliging</h2>
        <p><span class="welkomBol">Verander je wachtwoord of zet 2FA aan.</span></p>
    </div>



        <div class="row">




        <div class="col-md-5 reset-password">
            <div class="card">
                <div class="card-header">Verander je wachtwoord</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('veranderWachtwoordLogged',$userByCookie->userId) }}" >
                    @csrf
                        @if(\Session::has('error'))
                            <p class="error">
                                {{\Session::get('error')}}
                            </p>
                        @endif
                        @if(\Session::has('errorWoo'))
                            <p class="error">
                                {{\Session::get('error')}}
                            </p>
                        @endif
                        @if(\Session::has('succes'))
                            <p class="succes">
                                {{\Session::get('succes')}}
                            </p>
                        @endif
                        <input type="password" class="input-lg form-control mb-3" name="wachtwoord1" id="password1" placeholder="Nieuw wachtwoord" required >
                        <input type="password" class="input-lg form-control" name="wachtwoord2" id="password2" placeholder="Herhaal wachtwoord" required >
                        <div class="button-footer">
                            <button class="btn btn-primary" id="changeUserDetails" name="changeUserDetails" type="submit">Aanpassen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>








            <div class="col-md-6 col-center">
                <h4>Activeer Google 2FA</h4>
                <p>Met verificatie in 2 stappen (soms authenticatie in 2 stappen genoemd) kun je een extra beveiligingslaag aan je account toevoegen voor het geval je wachtwoord wordt gestolen. </p>
                <form method="GET" action="{{ route('login2FA') }}">
                    
                    <div class="">
                        <a href="#"><button class="btn btn-primary" id="enable2FA" name="enable2FA" type="submit">Activeer</button></a>
                    </div>
                </form>
            </div>


</div>

                                            

                                            




















