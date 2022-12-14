@extends( ($userByCookie->rol === 1) ? 'layouts.navBarAdmin' :  'layouts.navBar')
<title>Persoonsgegevens</title>
@section('content')


<style>

.box.persoonsgegevens {
    max-width: 900px;
}


    </style>

    <div class="main-grid-min-nav">
    <div class="wrapped-container">
    <div class="WelkomBanner">
        <h2>Persoongegevens</h2>
        <p><span class="welkomBol">Dit zijn je gegevens</span></p>
    </div>
    <div class="box persoonsgegevens">
        <form method="post" action="{{route('UpdateUserDetails')}}">

                            <div class="row">

                                @csrf
                                <div class="col-md-6">
                                    <label class="label-inputs">Naam</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" name="naam" value=<?php echo $userByCookie->naam ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-inputs" class="label-inputs">Email</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" name="email" value=<?php echo $userByCookie->email ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-inputs">Telefoonnummer</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" name="telefoonnummer" value=<?php echo $userByCookie->telefoonnummer ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-inputs">Bedijfsnaam</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" name="bedrijfsnaam" value=<?php echo $userByCookie->bedrijfsnaam ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-inputs">BTW-nummer</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" name="btw" value=<?php echo $userByCookie->btwNummer ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-inputs">Adres</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" name="adres" value=<?php echo $userByCookie->adres ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-inputs">Postcode</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" name="postcode" value=<?php echo $userByCookie->postcode ?>>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-inputs">Plaats</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="text" name="plaats" value=<?php echo $userByCookie->plaats ?>>
                                </div>
                            </div>
                            <div class="button-footer">
                            <a href="{{ route('UpdateUserDetails') }}"><button class="btn btn-primary" id="changeUserDetails" name="changeUserDetails" type="submit">Aanpassen</button></a>
                            </div>
                        </form>
            </div>
          </div>
        </div>
    </div>
    </div>
</div>





