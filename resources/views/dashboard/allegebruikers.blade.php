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
    <div class="userinput">
            <div class="links">
                <input type="email" id="userInput" name="email" placeholder='Email' required autocomplete="email"><br><br>
          
                <input type="text" id="userInput" name="userName" placeholder='Naam' required autocomplete="email"><br><br>
          
                <input type="text" id="userInput" name="Telefoonnummer" placeholder='Telefoonnummer (alleen getallen)' required><br><br>
          
                <input type="text" id="userInput" name="Bedijfsnaam" placeholder='Bedijfsnaam' required><br><br>
            </div>
            <div class="rechts">
                <input type="text" id="userInput" name="BTW-Nummer" placeholder='BTW-Nummer' required><br><br>
          
                <input type="text" id="userInput" name="Adres" placeholder='Adres+Huisnummer' required><br><br>
          
                <input type="text" id="userInput" name="Postcode" placeholder='Postcode' required><br><br>
          
                <input type="text" id="userInput" name="Plaats" placeholder='Plaats' required><br><br>

                <input type="text" id="userInput" name="FactuurId" placeholder='FactuursturenId' required><br><br>
                
            </div>
         </div> 
         <button id="buttonLogin" name="buttonregister" type="submit"  value="Registreren">{{ __('Registreren') }}</button><br><br>  
    </form>           
  </div>
</div>
<!-- Einde Popup! -->

<div class="leftColor">
    <div class="container1">
        <div class="row">
            <ul class="nav justify-content-center">
            <span id="MINTY">MINTY</span>
            <li>
                <a href="{{ route('dashboard') }}"><ion-icon size="large" name="home-outline"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large" name="apps-outline"></ion-icon><a>
            </li>
            <li>
                <a href="{{ route('persoonsgegevens') }}"><ion-icon size="large" name="people-outline"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large" name="file-tray-full-outline"></ion-icon></a>
            </li>
            <li>
                <a href="{{ route('allegebruikers') }}"><ion-icon size="Large" name="logo-playstation"></ion-icon></a>
            </li>
            <li>
                <a><ion-icon size="large"  name="settings-outline"></ion-icon></a>
            </li>
            </ul>
        </div>
    </div>
</div>

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




