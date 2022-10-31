<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link href="{{ asset('css/logintest.css') }}" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=0.5">

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

@extends( ($userByCookie->rol === 3) ? 'layouts.nav' :  'layouts.navAdmin')
@section('content')
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Persoonsgegevens</div>
                <div class="card-body">
                    <form>
                       @csrf
                        Naam<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->naam ?>><br>
                        Email<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->email ?>><br>
                        Telefoonnummer<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->telefoonnummer ?>><br>
                        Bedijfsnaam<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->bedrijfsnaam ?>><br>
                        BTW-Nummer<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->btwNummer ?>><br>
                        Adres<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->adres ?>><br>
                        Postcode<input class="form-control" type="text" id="text" placeholder=<?php echo $userByCookie->postcode ?>><br>
                        Plaats<input class="form-control" type="text" id="text" placeholder<?php echo $userByCookie->plaats ?>><br>
                        <a href="#"><button class="btn btn-primary" id="btnDeleteUser" name="createWooUserBTN" type="submit">Aanpassen</button></a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card mb-4">
                @if(\Session::has('error'))
                    <p class="error">
                        {{\Session::get('error')}}
                    </p>
                @endif
                <div class="card-header">Bol - Koppeling</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createBolUser',$userByCookie->userId) }}" >
                        @csrf
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Client Id</label>
                            <input class="form-control" id="inputUsername" name='clientId' type="text" >
                        </div>
                        <!-- Form Row-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Secret</label>
                            <input class="form-control" id="inputUsername" name='secret' type="text" >
                        </div>
                        <div class="col-md-3">
                            <br><label for="color">Land :</label>
                            <select name="land" id="color">
                                <option value="" selected>--- Maak uw keuze ---</option>
                                <option value="nl">Netherlands</option>
                                <option value="be">Belgium</option>
                                <option value="nl-be">Netherlands & Belgium</option>
                            </select>
                        </div>
                        <br>
                         <a href="{{ route('createBolUser',$userByCookie->userId) }}"><button class="btn btn-primary" id="btnDeleteUser" name="createBolUserBTN" type="submit">Versturen</button></a>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Woo - Koppeling</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createWooUser',$userByCookie->userId) }}" >
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Host</label>
                            <input class="form-control" id="inputUsername" name='wooClientHost' type="text" >
                        </div>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Woo Key</label>
                            <input class="form-control" id="inputUsername" name='wooClientKey' type="text" >
                        </div>
                        <!-- Form Row-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Secret</label>
                            <input class="form-control" id="inputUsername" name='wooClientSecret' type="text" >
                        </div>
                        <br>
                        <a href="{{ route('createBolUser',$userByCookie->userId) }}"><button class="btn btn-primary" id="btnDeleteUser" name="createWooUserBTN" type="submit">Versturen</button></a>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-header">Huidig Bol verbinding(en)</div>
        <div class="card-body">
            <div class="mb-3">
                <?php
                if (!empty($bolConnection)){
                    for ($x = 0; $x < count($bolConnection); $x++) {?>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Secret</label>
                            <input class="form-control" id="inputUsername" name='wooClientKey' placeholder=<?php echo $bolConnection[$x]->secret ?> >
                            <label class="small mb-1" for="inputUsername">client id</label>
                            <input class="form-control" id="inputUsername" name='wooClientKey' placeholder=<?php echo $bolConnection[$x]->clientId ?> >
                        </div>
                    <?php }
                } ?>
            </div>

        </div>
    </div>
</div>










</div>
</div>


