<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('css/persoonsgegevens.css') }}" rel="stylesheet">


<meta name="viewport" content="width=device-width, initial-scale=0.5">

<script src="{{ asset('js/popupgebruiker.js') }}"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

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

  <div class="klantgegevens">
    <h3>Klant details</h3>
    
    Naam<input type='text' placeholder=<?php echo $user->naam ?>></input>
    Email<input type='text' placeholder=<?php echo $user->email ?>></input>
    Telefoonnummer<input type='text' placeholder=<?php echo $user->telefoonnummer ?>></input>
    Bedijfsnaam<input type='text' placeholder=<?php echo $user->bedrijfsnaam ?>></input>
    Adres<input type='text' placeholder=<?php echo $user->adres ?>></input>
    Postcode<input type='text' placeholder=<?php echo $user->postcode ?>></input>
    Plaats<input type='text' placeholder=<?php echo $user->plaats ?>></input>
    Factuursturen klant nr.<input type='text' placeholder=<?php if(empty($user->factuurId )){echo "n.v.t.";}else{echo $user->factuurId;} ?>></input>

    
  </div>

 <div class="info">
  <div class="boldetails">
    <h3>Bol details</h3>
    <input placeholder="Koppeling:" class="row1-inline" readonly></input>
    <input type="text" placeholder="qwertyuiopasdfghjklzxcvbnm" class="row1-inline" id="kopp-adres"></input>
    <input type="text" placeholder="Show" class="row1-inline" id="show" readonly></input>

    <input type="button" class="inline" value="Blokkeer API voor klant"></input>
    <input type="button" class="inline" id="inloggenalsklant" value="Inloggen als deze klant"></input>
    <a href="{{ route('deleteUser',$user->userId) }}"><input type="button" class="inline" value="Verwijder klant"></input></a>
</div>

<div class="Status">
  <h3>Status</h3><br>
  <div class="links">
  Geverififeerd<input type="checkbox" id="test"<?php if($user->geverifieerd == TRUE){?>checked<?php }?> onclick="return false;">
  Geabonneerd<input type="checkbox" <?php if($user->geabonneerd == TRUE){?>checked<?php }?> onclick="return false;">
  API actief<input type="checkbox" <?php if($user->API == TRUE){?>checked<?php }?> onclick="return false;">
  Wordpress ingesteld<input type="checkbox" <?php if($user->wordpress == TRUE){?>checked<?php }?> onclick="return false;">
  Koppeling server<input type="text" id="text" placeholder=<?php if(!empty($user->server)){echo $user->server;} else{echo "n.v.t";}?> onclick="return false;">
  Koppeling geldig tm<input type="text" id="text" placeholder=<?php if(!empty($user->geldig)){echo $user->geldig;} else{echo "n.v.t";}?> onclick="return false;">
    <br> 
</div>
</div></div>
<div class="info2">
<div class="koppeling">
<input type="text" class="inputGeldig"><input type="button" id="btndagen" value="Dag(en)"><br>
<!-- Bereken hoelang koppeling nog geldig is -->
<?php 
$currentDateTime = date('Y-m-d H:i:s');
$datetime1 = strtotime($currentDateTime);
$datetime2 = strtotime($user->geldig);
if($datetime2 == false)$datetime2=$datetime1;
$secs = $datetime2 - $datetime1;// == <seconds between the two times>
 $days = floor(($secs%2592000)/86400);?>

Koppeling is nog <?php echo $days?> dag(en) geldig.<br><br>
Voer een numerieke waarde in om de vervaldatum van de koppeling te wijzigen.
</div>
</div>

<div class="factuurSectie">
    Facturing
</div>


</div>


</div>


