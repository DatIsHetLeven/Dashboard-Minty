<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
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
    <div class="container">
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
                <a class="instellinglogo"><ion-icon size="large"  name="settings-outline"></ion-icon></a>
            </li>
            </ul>
        </div>
    </div>
</div>

<!-- Alle gebruikers tonen -->
<h3> Alle Gebruikers</h3>



<div class="alleGebruikersForm" class="overlay">

  <button class="show" onclick="show();">Gebruiker toevoegen</button>
  <table style="border-collapse:collapse;" class="table-table" id="data-table">
    <thead>
      <tr>
        <th>Gebruiker</th>
        <th>Bedrijfsnaam</th>
        <th>Email</th>
        <th>factuursturen</th>
        <th>Geverififeerd</th>
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
            <td><input type="checkbox" id="test"<?php if($allegebruikers[$x]->geverifieerd == TRUE){?>checked<?php }?> onclick="return false;"></td>
            <td><input type="checkbox" id="test"<?php if($allegebruikers[$x]->geverifieerd == TRUE){?>checked<?php }?> onclick="return false;"></td>
        </tr>
      </div>
        <?php
        }?></tbody>
</div>



