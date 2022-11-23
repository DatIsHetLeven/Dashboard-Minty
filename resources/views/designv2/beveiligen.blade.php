@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Beveiligen</title>
@section('content')

    <style>


        * { box-sizing: border-box; }

        body {
            font-family: 'Open Sans', sans-serif;
            color: #666;
        }

        /* STRUCTURE */

        .wrapper {
            padding: 5px;
            max-width: 960px;
            width: 95%;
            margin: 20px auto;
        }


        .columns {
            display: flex;
            flex-flow: row wrap;
            justify-content: center;
            margin: 5px 0;
        }

        .column {
            flex: 1;
            border: 1px solid gray;
            margin: 2px;
            padding: 10px;
        &:first-child { margin-left: 0; }
        &:last-child { margin-right: 0; }

        }




        @media screen and (max-width: 980px) {
            .columns .column {
                margin-bottom: 5px;
                flex-basis: 40%;
        &:nth-last-child(2) {
             margin-right: 0;
         }
        &:last-child {
             flex-basis: 100%;
             margin: 0;
         }
        }
        }

        @media screen and (max-width: 680px) {
            .columns .column {
                flex-basis: 100%;
                margin: 0 0 5px 0;
            }
        }
        @media screen and (max-width: 1500px) {
            .columns .column {
                flex-basis: 100%;
                margin: 0 0 5px 0;
                margin-left: 15%;
            }
        }
        </style>

    <div class="wrapper">

        <header>
            <h1></h1>
        </header>

        <section class="columns">

            <div class="column">
                <h2>Activeer Google 2FA</h2>
                <p>Met verificatie in 2 stappen (soms authenticatie in 2 stappen genoemd) kun je een extra beveiligingslaag aan je account toevoegen voor het geval je wachtwoord wordt gestolen. </p>
                <form method="GET" action="{{ route('2FA') }}">
                    <a href="#"><button class="btn btn-primary" id="enable2FA" name="enable2FA" type="submit">Activeer</button></a>
                </form>
            </div>

            <div class="column">
                <h2>Verander je wachtwoord</h2>
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

                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <form method="post" id="passwordForm">
                                                <input type="password" class="input-lg form-control" name="wachtwoord1" id="password1" placeholder="Nieuw wachtwoord" required >
                                                <input type="password" class="input-lg form-control" name="wachtwoord2" id="password2" placeholder="Herhaal wachtwoord" required >
                                                <div class="row">
                                                </div>
                                                <button class="btn btn-primary" id="changeUserDetails" name="changeUserDetails" type="submit">Aanpassen</button>
                                            </form>
                                        </div><!--/col-sm-6-->
                                    </div>

            </form>

    </div>

        </section>
    </div>

