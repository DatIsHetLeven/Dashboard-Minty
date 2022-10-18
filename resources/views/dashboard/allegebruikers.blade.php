<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="{{ asset('css/persoonsgegevens.css') }}" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=0.5">

<script src="{{ asset('js/popupgebruiker.js') }}"></script>
<script src="{{ asset('js/popupToevoegen.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<div class="popUp" id="popUp-1">
  <div class="overlay" onclick="show();"></div>
  <div class="content">
    <div class="close-btn" onclick="show();">&times;</div>
<!-- Begin van de popup -> gebruiker toevoegen -->
<form method="POST" action="{{ route('create_user_check') }}" class="formRegister">
    @csrf
    <div class="col-xl-10">
        <div class="card mb-7">
                <div class="card-header">Niuewe gebruiker</div>
                <div class="card-body">
                    <form>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                        <!-- Form Group (organization name)-->
                          <div class="col-md-6">
                            <input class="form-control" id="inputOrgName" type="text" name="email" placeholder='Email' required autocomplete="email">
                          </div>
                          <!-- Form Group (location)-->
                          <div class="col-md-6">
                            <input class="form-control" id="inputLocation" type="text" name="userName" placeholder='Naam' required autocomplete="email">
                          </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <input class="form-control" id="inputFirstName" type="text" name="Telefoonnummer" placeholder='Telefoonnummer' required>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <input class="form-control" id="inputLastName" type="text" name="Bedijfsnaam" placeholder='Bedijfsnaam' required>
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <input class="form-control" id="inputOrgName" type="text" name="BTW-Nummer" placeholder='BTW-Nummer' required>
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <input class="form-control" id="inputLocation" type="text" name="Adres" placeholder='Adres+Huisnummer' required>
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <input class="form-control" id="inputPhone" type="text" name="Postcode" placeholder='Postcode' required>
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <input class="form-control" id="inputBirthday" type="text" name="Plaats" placeholder='Plaats' required>
                            </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <input class="form-control" id="inputPhone" type="text" name="FactuurId" placeholder='FactuursturenId' required>
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                              <br><label for="color">functie:</label>
                              <select name="userRole" id="color">
	                              <option value="">--- Kies een functie ---</option>
	                              <option value="Admin">Admin</option>
	                              <option value="Proefaccount" selected>Klant(14 dagen proef)</option>
                              </select>
                            </div>
                        </div>
                        <button id="buttonLogin" name="buttonregister" type="submit"  value="Registreren">{{ __('Registreren') }}</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>
<!-- Einde Popup! -->


@extends('layouts.navAdmin')
@section('content')

<div class="alleGebruikersForm" class="overlay">
  <button class="show" onclick="show();">Gebruiker toevoegen</button>
  <div class="table-pos">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Gebruiker</th>
                <th>Bedrijfsnaam</th>
                <th>Email</th>
                <th>Factuursturen</th>
                <th>geverifieerd</th>
                <th>Geabonneerd</th>
                <th>API actief</th>
            </tr>
        </thead>
    <tbody><?php
    $count = 0;
    for ($x = 0; $x < count($allegebruikers); $x++) {?>
      <div class="perGeberuiker" value={{$count}}>
        <tr>
            <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->naam; ?></a></td>
            <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->bedrijfsnaam; ?></td>
            <td><a href="{{ route('seeCustomerDetail',$allegebruikers[$x]->userId) }}"><?php echo $allegebruikers[$x]->email; ?></td>
            <?php $count++;?>
            <td><a href="{{ route('createUserFactuursturen',$allegebruikers[$x]->userId) }}" value=<?php $count?>>Add</a>
            <td><input type="checkbox" id="test"<?php if($allegebruikers[$x]->geverifieerd == TRUE){?>checked<?php }?> onclick="return false;"></td>
            <td><input type="checkbox" id="test"<?php if($allegebruikers[$x]->geabonneerd == TRUE){?>checked<?php }?> onclick="return false;"></td>
            <td><input type="checkbox" id="test"<?php if($allegebruikers[$x]->API == TRUE){?>checked<?php }?> onclick="return false;"></td>
        </tr>
      </div>
        <?php
        }?></tbody></table>
</div>
</div>

<div class="factuurGebruikerOphalen">

  <form name="form" action="{{ route('getFactuursturenUser') }}" method="post">
  @csrf
    Klant ophalen uit Factuursturen dmv factuurid
    <input type="text" name="factuurId" id='factuurId' value="test">

    <button type="submit" name="btnFactuurId" id='factuurId' value="Ophalen">Ophalen</button>
  </form>

      </div>
</div>


@endsection

