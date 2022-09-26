<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('css/persoonsgegevens.css') }}" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=0.5">

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
<h3> Alle Gebruikers</h3>
<div class="alleGebruikersForm">
    <?php
    
    for ($x = 0; $x < count($allegebruikers); $x++) {
        echo $allegebruikers[$x]->naam, " ";
        echo $allegebruikers[$x]->email, " ";
        echo $allegebruikers[$x]->telefoonnummer, " ";
        echo $allegebruikers[$x]->bedrijfsnaam, " ";
        echo $allegebruikers[$x]->btwNummer, " ";
        echo $allegebruikers[$x]->adres, " ";
        echo $allegebruikers[$x]->postcode, " ";
        echo $allegebruikers[$x]->plaats, " ";

        echo nl2br("\n"); echo nl2br("\n");
      }




?>
</div>